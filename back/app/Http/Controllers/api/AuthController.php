<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $payload    =   auth()->payload();

        $credentials = request(['email', 'password']);
        try {
            if (! $token = auth()->attempt($credentials))
                return jsonResponse(status:401, message: 'Unauthorized');
            
            return jsonResponse(data: [
                'token'         => $token,
                'expires_in'    => auth()->factory()->getTTL() * 60
            ]);
            
        } catch (\Throwable $th) {
            return jsonResponse(status:500, message: 'Internal Server Error');
        }


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
