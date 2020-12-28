<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return ['success' => true, 'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ]];
        }
        return ['success' => false, 'error' => 'The provided credentials do not match our records.'];
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return ['success' => true];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function signup(Request $request)
    {
        $validated = $request->validate([ // 422
            'name' => 'required|max:200',
            'email' => 'bail|required|email:rfc|max:200|unique:users',
            'password' => 'required|max:200',
        ]);
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');
        $userStub = $request->only('email', 'password', 'name');
        $userStub['password'] = Hash::make($userStub['password']);
        $u = User::create($userStub);
        $u->save();
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return ['success' => true, 'user' => [
                'name' => $u->name,
                'email' => $u->email,
            ]];
        }
        return ['success' => false, 'error' => 'User creation failed.'];
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function whoami(Request $request)
    {
        $user = Auth::user();
        if (!$user) return ['success' => false];
        return ['success' => true, 'user' => [
            'name' => $user->name,
            'email' => $user->email,
        ]];
    }
}
