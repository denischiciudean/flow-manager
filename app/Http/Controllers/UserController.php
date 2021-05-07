<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{

    public function __construct()
    {

    }


    public function verifyPhone(Request $request)
    {
        $request->validate(['phone' => 'required|string|min:12|max:12']);
        $success = $request->user()->sendVerifyPhoneSMS($request->get('phone'));
        return JsonResource::make([
            'success' => $success
        ]);
    }

    public function verifyPhoneCode(Request $request)
    {
        $request->validate(['code' => 'required|string|min:6|max:6']);
        $success = $request->user()->verifyPhoneCode($request->get('code'));
        return redirect()->route($success ? 'dashboard' : 'login');
    }

    public function activateTfa()
    {
        return inertia('Auth/TwoFactorAuth');
    }


    public function index()
    {

    }

    public function settings()
    {

    }
}
