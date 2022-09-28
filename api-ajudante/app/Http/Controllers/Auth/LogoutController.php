<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'user logged out'
        ];
    }
}
