<?php

namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        Validator::make($request->all(), [
            "name" => "required|min:3|max:250",
            "email" => "required|email|max:250",
            "password" => "required|min:6|max:64|confirmed",
        ])->validate();

        User::create([
            "name" => $request['name'],
            "email" => $request['email'],
            "password" => Hash::make($request['password']),
        ]);

        return response()->json(["message" => "registered successfully", "token" => $this->generateToken($request['email'])]);
    }

    public function login(Request $request)
    {
        Validator::make($request->all(), [
            "email" => "required|email|max:250",
            "password" => "required|min:6|max:64",
        ])->validate();

        $user = User::whereEmail($request['email']);

        if (!$user) {
            return response()->json(["error" => "email or password doesn't match our records"], 422);
        }

        if (!Hash::check($user->password, $request['password'])) {
            return response()->json(["error" => "email or password doesn't match our records"], 422);
        }

        return response()->json(["message" => "authenticated successfully", "token" => $this->generateToken($request['email'])]);
    }

    private function generateToken($email)
    {
        $payload = array(
            "iss" => "https://kyri.me",
            "iat" => Carbon::now()->unix(),
            "nbf" => Carbon::now()->unix(),
            "exp" => Carbon::now()->addYear()->unix(),
            "tenant" => app()['tenant']->id,
            "email" => $email,
        );

        return JWT::encode($payload, env("APP_KEY"), 'HS256');
    }
}
