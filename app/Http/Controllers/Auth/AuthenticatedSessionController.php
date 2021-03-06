<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\StateTrack\StateTrack;
use App\StateTrack\UserStateTrack;
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

    private function wrongCredentials()
    {
        return redirect()->route('login')->withErrors(['message' => 'These credentials do not match our records']);
    }

    private function wrongPhoneCode()
    {
        return redirect()->route('login')->withErrors(['message' => 'Phone verification not passed!']);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

        $active_topt = true;

        $email = $request->has('email') ? $request->get('email') : json_decode(decrypt(\Session::get('c')), 1)['email'];

        if ($request->has('email')) {
            $user = User::where('email', $email)->first();
            if (!$user) {
                return $this->wrongCredentials();
            }
            $active_topt = (bool)$user->phone_verified_at;
        }

        if ($active_topt) {
            if ($request->has('2fa')) {
                $success = $this->sendSms($request->get('email'));
                if (!$success) {
                    return $this->wrongCredentials();
                }
                \Session::put('c', encrypt(json_encode($request->only(['email', 'password']))));
                return redirect()->route('login.sms');
            }

            if (!$request->has('2fa') && !\Session::has('c')) {
                return $this->wrongPhoneCode();
            }

            $request_data = json_decode(decrypt(\Session::get('c')), 1);
            $code_verification = User::where('email', $request_data['email'])->first()?->verifyCode($request->get('code'));

            if (!$code_verification) {
                return $this->wrongPhoneCode();
            }

            \Session::remove('c');


            $request->merge($request_data);
        }

        try {
            $request->authenticate();
        } catch (ValidationException $e) {
            return $this->wrongCredentials();
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
        Auth::user()->track_logout();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
