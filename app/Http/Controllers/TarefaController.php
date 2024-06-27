<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Services\Response;
use App\Http\Requests\Tarefa\StoreRequest;
use App\Http\Requests\Tarefa\UpdateRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class TarefaController extends Controller
{
    public function index(){
        $tarefas = Tarefa::all();
        return Response::data($tarefas);
    }

    public function show(Tarefa $tarefa){
        return Response::data($tarefa);
    }

    public function store(StoreRequest $request){
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        Tarefa::create($input);
        return Response::success('Tarefa criada com sucesso!', SymfonyResponse::HTTP_CREATED);
    }

    public function ativo($id){
        $tarefaFixa = Tarefa::findOrFail($id);
        $tarefaFixa->ativo = !$tarefaFixa->ativo;
        $tarefaFixa->save();
        
        return Response::success('Status da tarefa alterado com sucesso!');
    }

    public function destroy(Tarefa $tarefa){
        $tarefa->delete();
        return Response::success('Tarefa removida com sucesso!');  
    }

    public function update(UpdateRequest $request, Tarefa $tarefa){
        $tarefa->update($request->all());
        return Response::success('Tarefa atualizada com sucesso!');
    }

    public function destroyAll(){
        $tarefas = Tarefa::where('user_id', Auth::user()->id)->get();
      
        foreach($tarefas as $tarefa){
            if($tarefa->ativo == true){
                $tarefa->delete();
            }
        }
        return Response::success('Todas as tarefas concluidas removidas com sucesso!');
    }
}
