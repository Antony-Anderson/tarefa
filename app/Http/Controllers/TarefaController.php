<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Services\Response;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function index(){
        $tarefas = Tarefa::all();
        return Response::data($tarefas);
    }
}
