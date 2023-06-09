<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status'  => false,
                    'message' => 'Failed Register',
                    'data' => $validator->errors()
                ]
            );
        }

        $input = $request->all();
        $input['password'] = bcrypt($request['password']);
        $user = User::create($input);

        $success['accessToken'] = $user->createToken('auth_token')->plainTextToken;
        $success['tokenType'] = 'Bearer';
        $success['name'] = $user->name;

        return response()->json([
            'status'  => true,
            'message' => 'Success Register',
            'data'  => $success
        ]);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['accessToken'] = $auth->createToken('auth_token')->plainTextToken;
            $success['tokenType'] = 'Bearer';
            $success['name'] = $auth->name;

            return response()->json([
                'status' => true,
                'message' => 'Login Success',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Login Failed, Please check your Username or Email',
                'data' => null
            ]);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response()->json([
            'status' => true,
            'message' => 'Logout Success',
            'data' => null
        ]);
    }
}
