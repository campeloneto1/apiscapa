<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Perfil;
use App\Models\Log;

class PerfisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Perfil::orderBy('nome')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
         $data = new Perfil;
   
        $data->nome = $request->nome; 
        $data->administrador = $request->administrador; 
        $data->gestor = $request->gestor; 

        $data->acessos = $request->acessos; 
        $data->acessos_cad = $request->acessos_cad; 
        $data->acessos_edt = $request->acessos_edt;         
        $data->acessos_del = $request->acessos_del; 

        $data->pessoas = $request->pessoas; 
        $data->pessoas_cad = $request->pessoas_cad; 
        $data->pessoas_edt = $request->pessoas_edt;         
        $data->pessoas_del = $request->pessoas_del; 
      
        $data->orgaos = $request->orgaos; 
        $data->orgaos_cad = $request->orgaos_cad; 
        $data->orgaos_edt = $request->orgaos_edt;         
        $data->orgaos_del = $request->orgaos_del; 

        $data->setores = $request->setores; 
        $data->setores_cad = $request->setores_cad; 
        $data->setores_edt = $request->setores_edt;         
        $data->setores_del = $request->setores_del; 

        $data->postos = $request->postos; 
        $data->postos_cad = $request->postos_cad; 
        $data->postos_edt = $request->postos_edt;         
        $data->postos_del = $request->postos_del; 

        $data->niveis = $request->niveis; 
        $data->niveis_cad = $request->niveis_cad; 
        $data->niveis_edt = $request->niveis_edt;         
        $data->niveis_del = $request->niveis_del; 

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Perfil';
            $log->table = 'perfis';
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Perfil::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = Perfil::find($id);
        $dataold = $data;

        $data->nome = $request->nome; 
        $data->administrador = $request->administrador; 
        $data->gestor = $request->gestor; 

        $data->acessos = $request->acessos; 
        $data->acessos_cad = $request->acessos_cad; 
        $data->acessos_edt = $request->acessos_edt;         
        $data->acessos_del = $request->acessos_del; 

        $data->pessoas = $request->pessoas; 
        $data->pessoas_cad = $request->pessoas_cad; 
        $data->pessoas_edt = $request->pessoas_edt;         
        $data->pessoas_del = $request->pessoas_del; 
      
        $data->orgaos = $request->orgaos; 
        $data->orgaos_cad = $request->orgaos_cad; 
        $data->orgaos_edt = $request->orgaos_edt;         
        $data->orgaos_del = $request->orgaos_del; 

        $data->setores = $request->setores; 
        $data->setores_cad = $request->setores_cad; 
        $data->setores_edt = $request->setores_edt;         
        $data->setores_del = $request->setores_del; 

        $data->postos = $request->postos; 
        $data->postos_cad = $request->postos_cad; 
        $data->postos_edt = $request->postos_edt;         
        $data->postos_del = $request->postos_del; 

        $data->niveis = $request->niveis; 
        $data->niveis_cad = $request->niveis_cad; 
        $data->niveis_edt = $request->niveis_edt;         
        $data->niveis_del = $request->niveis_del; 
      
        $data->updated_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Perfil';
            $log->table = 'perfis';
            $log->action = 2;
            $log->fk = $data->id;
            $log->object = $data;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = Perfil::find($id);
         
         if($data->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Perfil';
            $log->table = 'perfis';
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
