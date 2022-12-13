<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(Request $request){
        $request->validate([
           'success' => ['required', 'email'],
           'password' => ['required', 'string'],
           'device_name' => ['required', 'string'],
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $token = $user->createToken($request->input('device_name'))->plainTextToken();
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => $token,
            'user' => $user->toArray(),
        ]);
    }
}
