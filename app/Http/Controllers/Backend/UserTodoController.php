<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserTodoController extends Controller
{
    function userCreatePage()
    {
        return view('pages.backend.home.create');
    }
    function userEditPage()
    {
        return view('pages.backend.home.edit');
    }
    function userReadPage()
    {
        return view('pages.backend.home.show');
    }
    function userGet()
    {
        $users = User::latest()->get();

        return $users;
    }
    function userCreate(Request $request)
    {
        try {
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User not created!'
            ], 200);
        }
    }
    function userRead(Request $request)
    {
        try {
            $email = $request->email;
            $user = User::where('email', '=', $email)->first();
            if ($user->is_read == 0) {
                User::where('email', '=', $email)->update([
                    'is_read' => 1
                ]);
            }
            return response()->json([
                'status' => 'success'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User is not detected!'
            ], 200);
        }
    }
    function userInfoShow(Request $request)
    {
        try {
            $email = $request->email;
            $user = User::where('email', '=', $email)->first();

            return response()->json([
                'status' => 'success',
                'user' => $user
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'This user is not detected!'
            ]);
        }
    }
    function userGetEdit(Request $request)
    {
        try {
            $email = $request->email;
            $user = User::where('email', '=', $email)->first();
            
            return response()->json([
                'status' => 'success',
                'user' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User is not detected!'
            ], 200);
        }
    }
    function userUpdate(Request $request)
    {
        try {
            $email = $request->input('email');
            User::where('email', '=', $email)->update([
                'name' => $request->input('name'),
                'email' => $email
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'This user updated successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'This user has been not updated!'
            ], 200);
        }
    }
    function userDelete($email)
    {
        try {
            User::where('email', '=', $email)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'This user has been deleted success!'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'This user has not detected!'
            ]);
        }
    }
}
