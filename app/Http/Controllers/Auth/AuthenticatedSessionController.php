<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    public function sms(Request $request)
    {
        return Inertia::render('Auth/TwoFactorAuthChallenge');
    }

    private function sendSms(string $email)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            return false;
        }
        return $user->sendTOTPSms();
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        if ($request->has('2fa')) {
            $success = $this->sendSms($request->get('email'));
            if (!$success) {
                return redirect()->route('login')->withErrors(['message' => 'Phone verification not passed!']);
            }
            \Session::put('c', encrypt(json_encode($request->only(['email', 'password']))));
            return redirect()->route('login.sms');
        }

        if (!$request->has('2fa') && !\Session::has('c')) {
            return redirect()->route('login')->withErrors(['message' => 'Phone verification not passed!']);
        }

        $request_data = json_decode(decrypt(\Session::get('c')), 1);
        $code_verification = User::where('email', $request_data['email'])->first()?->verifyCode($request->get('code'));

        if (!$code_verification) {
            return redirect()->route('login')->withErrors(['message' => 'Phone verification not passed!']);
        }

        \Session::remove('c');

        $request->merge($request_data);


        try {
            $request->authenticate();
        } catch (ValidationException $e) {
            return redirect()->route('login')->withErrors(['message' => 'These credentials do not match our records']);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
