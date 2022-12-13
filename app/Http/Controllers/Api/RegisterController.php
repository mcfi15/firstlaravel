<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = (new CreateNewUser)->create($request->all());
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Registrations successful'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'failed to create account',
        ], 400);
    }
}
