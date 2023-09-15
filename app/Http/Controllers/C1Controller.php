<?php

namespace App\Http\Controllers;

use App\Models\C1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class C1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->perfil->c1){
            return response()->json('Não Autorizado', 401);
        }
         return C1::orderBy('nome')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->c1_cad){
            return response()->json('Não Autorizado', 401);
        }
        $data = new C1;

        $data->nome = $request->nome;  
        $data->nome_guerra = $request->nome_guerra;  
        $data->graduacao_id = $request->graduacao_id;  
        $data->apelido = $request->apelido;   
        $data->telefone1 = $request->telefone1;   
        $data->telefone2 = $request->telefone2;  
        $data->telefone3 = $request->telefone3;  
        $data->obs = $request->obs;  

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um contato no C1';
            $log->table = 'c1';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Contato cadastrado com sucesso!', 200);
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
     * @param  \App\Models\C1  $c1
     * @return \Illuminate\Http\Response
     */
    public function show(C1 $c1)
    {
        if(!Auth::user()->perfil->c1){
            return response()->json('Não Autorizado', 401);
        }
        return $c1;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\C1  $c1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, C1 $c1)
    {
        if(!Auth::user()->perfil->c1_edt){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $c1;

        $c1->nome = $request->nome;   
        $c1->graduacao_id = $request->graduacao_id;  
        $c1->nome_guerra = $request->nome_guerra;  
        $c1->apelido = $request->apelido;  
        $c1->telefone1 = $request->telefone1;   
        $c1->telefone2 = $request->telefone2;  
        $c1->telefone3 = $request->telefone3;  
        $c1->obs = $request->obs;  

        $c1->updated_by = Auth::id();      

        if($c1->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Contato no C1';
            $log->table = 'c1';
            $log->action = 2;
            $log->fk = $c1->id;
            $log->object = $c1;
            $log->object_old = $dataold;
            $log->save();
             return response()->json('Contato editado com sucesso!', 200);
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
     * @param  \App\Models\C1  $c1
     * @return \Illuminate\Http\Response
     */
    public function destroy(C1 $c1)
    {
        if(!Auth::user()->perfil->c1_del){
            return response()->json('Não Autorizado', 401);
        }
         
        if($c1->delete()){
           $log = new Log;
           $log->user_id = Auth::id();
           $log->mensagem = 'Excluiu um contato do C1';
           $log->table = 'c1';
           $log->action = 3;
           $log->fk = $c1->id;
           $log->object = $c1;
           $log->save();
           return response()->json('Contato excluído com sucesso!', 200);
         }else{
           $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
         }
    }
}
