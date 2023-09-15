<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Setor::orderBy('nome')->get();
        $user = Auth::user();
        if($user->perfil->administrador){
             return Funcionario::orderBy('nome')->get();
        }else{ 
            return Funcionario::whereRelation('setor','orgao_id', $user->orgao_id)->orderBy('nome')->get();
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->funcionarios_cad){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Funcionario;
   
        $data->setor_id = $request->setor_id;   
        $data->nome = $request->nome;   
        $data->ramal1 = $request->ramal1;   
        $data->ramal2 = $request->ramal2;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Funcionario';
            $log->table = 'funcionarios';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Informação cadastrada com sucesso!', 200);
        }else{
             $erro = "Não foi possivel realizar o cadastro!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        return $funcionario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        if(!Auth::user()->perfil->funcionarios_edt){
            return response()->json('Não Autorizado', 401);
        }


        $dataold = $funcionario;

        $funcionario->setor_id = $request->setor_id;   
        $funcionario->nome = $request->nome;   
        $funcionario->ramal1 = $request->ramal1;   
        $funcionario->ramal2 = $request->ramal2;   

        $funcionario->updated_by = Auth::id();      

        if($funcionario->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Funcionario';
            $log->table = 'funcionarios';
            $log->action = 2;
            $log->fk = $funcionario->id;
            $log->object = $funcionario;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Informação editada com sucesso!', 200);
        }else{
           $erro = "Não foi possivel realizar a edição!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionario $funcionario)
    {
        if(!Auth::user()->perfil->funcionarios_del){
            return response()->json('Não Autorizado', 401);
        }
        
         
         if($funcionario->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Funcionário';
            $log->table = 'funcionarios';
            $log->action = 3;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Informação escluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
