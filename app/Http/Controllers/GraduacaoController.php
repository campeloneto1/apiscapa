<?php

namespace App\Http\Controllers;

use App\Models\Graduacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class GraduacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Graduacao::orderBy('nome')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Graduacao;

        $data->nome = $request->nome;  
        $data->abreviatura = $request->abreviatura;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Graduacao';
            $log->table = 'graduacoes';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Graduação cadastrada com sucesso!', 200);
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
     * @param  \App\Models\Graduacao  $graduaco
     * @return \Illuminate\Http\Response
     */
    public function show(Graduacao $graduaco)
    {
        return $graduaco;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Graduacao  $graduaco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Graduacao $graduaco)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $graduaco;

        $graduaco->nome = $request->nome;  
        $graduaco->abreviatura = $request->abreviatura;   

        $graduaco->updated_by = Auth::id();      

        if($graduaco->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Graduação';
            $log->table = 'graduacoes';
            $log->action = 2;
            $log->fk = $graduaco->id;
            $log->object = $graduaco;
            $log->object_old = $dataold;
            $log->save();
             return response()->json('Graduação editado com sucesso!', 200);
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
     * @param  \App\Models\Graduacao  $graduaco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graduacao $graduaco)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
         
        if($graduaco->delete()){
           $log = new Log;
           $log->user_id = Auth::id();
           $log->mensagem = 'Excluiu um Graduação';
           $log->table = 'graduacoes';
           $log->action = 3;
           $log->fk = $graduaco->id;
           $log->object = $graduaco;
           $log->save();
           return response()->json('Graduação excluído com sucesso!', 200);
         }else{
           $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
         }
    }
}
