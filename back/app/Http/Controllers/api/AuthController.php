<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * 
     */
    public function login(Request $request)
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    /**
     * 
     */
    public function logout()
    {
        return response()->json([
            'name' => 'Assbigail',
            'state' => 'CssA',
        ]);
    }

  
}
