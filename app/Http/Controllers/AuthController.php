<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login()
    {
        return view('pages.auth.login');
    }
    function register()
    {
        return view('pages.auth.register');
    }
    function registerRequest(Request $request)
    {
        $email = $request->input('email');
        $checkUser = User::where('email', '=', $email)->first();
        if(!$checkUser)
        {
            User::create([
                'name' => $request->input('name'),
                'email' => $email,
                'password' => Hash::make($request->input('password'))
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Your account created successfully!'
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Already register using this email'
            ], 200);
        }
    }

    function loginRequest(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $checkUser = User::where('email', '=', $email)->first();
        $userRole = $checkUser->role;
        $check = Hash::check($password, $checkUser->password);
        if($check)
        {
            $token = JWTToken::createToken($email);

            return response()->json([
                'status' => 'success',
                'message' => 'Your account login successfully!',
                'userRole' => $userRole
            ], 200)->cookie('token', $token, 60 * 60 * 24);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Please enter your correct email or password!'
            ], 200);
        }
    }
    function logout()
    {
        return redirect()->route('login.page')->cookie('token', '', -1);
    }
}
