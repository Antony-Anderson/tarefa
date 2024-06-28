<?php

namespace App\Http\Controllers;

use App\Http\Requests\Perfil\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\Response;

class PerfilController extends Controller
{
    public function profile(){
        $user = Auth::user();
        return Response::data([
            'nome' => $user->name,
            'email' => $user->email
        ]);
        // dd($nome);
    }

    public function mudarSenha(UpdateRequest $request)
    {
        $user = Auth::user();

        $user->password = $request['newPassword'];
        $user->update();

        return Response::success('Senha alterada com sucesso');
    }
}
