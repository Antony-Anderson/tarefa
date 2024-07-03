<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pomodoro\StoreRequest;
use App\Models\Pomodoro;
use App\Services\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Illuminate\Http\Request;

class PomodoroController extends Controller
{

    public function index(){
        $pomodoro = Pomodoro::all();
        return Response::data($pomodoro);
    }

    public function store(StoreRequest $request){
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        Pomodoro::create($input);
        return Response::success('Tarefa criada com sucesso!', SymfonyResponse::HTTP_CREATED);
    }

    public function destroy(Pomodoro $pomodoro){
        $pomodoro->delete();
        return Response::success('Tarefa removida com sucesso!');  
    }

    public function deleteAll(){
        $tarefas = Pomodoro::where('user_id', Auth::user()->id)->get();
        foreach($tarefas as $tarefa){
            $tarefa->delete();
        }
        return Response::success('Todas as tarefas concluidas removidas com sucesso!');
    }
}
