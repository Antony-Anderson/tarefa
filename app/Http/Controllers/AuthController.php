<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Response;
use App\Http\Requests\Auth\StoreRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class AuthController extends Controller
{
    public function store(StoreRequest $request){
        $user = User::create($request->all());
        $token = $user->createToken($user->email);
        return Response::success('Usuário cadastrado com sucesso', SymfonyResponse::HTTP_CREATED, ['token' => $token->plainTextToken]);
    }

    public function show(){
        $user = User::find(Auth::user()->id);
        return Response::data($user);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
               'email' => 'Email ou/e senha incorretas',
            ]);
        } 
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken($user->email);
        return Response::success('Login efetuado com sucesso', SymfonyResponse::HTTP_OK, ['token' => $token->plainTextToken]);
    }

    public function telaLogin(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function logout(){
        $user = User::find(Auth::user()->id);
        $user->tokens()->delete();
        return Response::success('Logout efetuado com sucesso');
    }
}
