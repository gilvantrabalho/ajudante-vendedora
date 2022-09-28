<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            $credentials = $request->only('name', 'username', 'password');
            $validator = Validator::make($credentials, [
                'name' => 'required|string',
                'username' => 'required|string',
                'password' => 'required'
            ], [
                'name.required' => 'Nome é um campo obrigatório.',
                'username.required' => 'Username é um campo obrigatório.',
                'password.required' => 'Senha é um campo obrigatório.',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            $user = new User([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);
            $user->save();

            return response()->json([
                'error' => false,
                'response' => [
                    'message' => 'Usuário cadastrado com sucesso!',
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'response' => [
                    'message' => json_decode($e->getMessage())
                ]
            ]);
        }
    }
}
