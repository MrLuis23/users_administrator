<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // $request->validate();
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return jsonResponse(status:401, message: 'Unauthorized');
        }

        return jsonResponse(data: [
            'token' => $token,
            'expires_in'=> auth()->factory()->getTTL() * 60
        ]);

    }

    /**
     * 
     */
    public function logout()
    {
        auth()->logout();
        return jsonResponse(
            message: 'Successfully logged out',
            status: 200
        );
    }

  
}
