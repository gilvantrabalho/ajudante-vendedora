<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $validator = Validator::make($credentials, [
            'username' => 'required|string',
            'password' => 'required'
        ], [
            'username.required' => 'Username é um campo obrigatório.',
            'password.required' => 'Senha é um campo obrigatório.',
        ]);


        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'error' => true,
                'response' => [
                    'message' => "Email e/ou senha incorreto!"
                ]
            ]);
        }

        $token = auth()->user()->createToken('auth_token');

        return response()->json([
            'error' => false,
            'response' => [
                'message' => 'Token gerado com sucesso!',
                'token' => $token->plainTextToken
            ]
        ]);
    }
}
