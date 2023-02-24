<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Acesso;
use App\Models\Log;

class AcessosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Carbon::now();
        //return Acesso::orderBy('id', 'desc')->get();
        $user = Auth::user();
        if($user->perfil->administrador){
             return Acesso::whereDate('data_hora', $data)->orderBy('id', 'desc')->get();
        }else{ 
            return Acesso::whereDate('data_hora', $data)->whereRelation('setor','orgao_id', $user->orgao_id)->orderBy('id', 'desc')->get();
        } 

       
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
        if(!Auth::user()->perfil->acessos_cad){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Acesso;
   
        $data->posto_id = $request->posto_id;   
        $data->setor_id = $request->setor_id;   
        $data->pessoa_id = $request->pessoa_id;  
        $data->obs = $request->obs;   
        $data->data_hora = Carbon::now();   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Acesso';
            $log->table = 'acessos';
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
        return Acesso::find($id);
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
        if(!Auth::user()->perfil->acessos_edt){
            return response()->json('Não Autorizado', 401);
        }
        $data = Acesso::find($id);
        $dataold = $data;

        $data->posto_id = $request->posto_id;   
        $data->setor_id = $request->setor_id;   
        $data->pessoa_id = $request->pessoa_id;  
        $data->obs = $request->obs;   
        $data->updated_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Acesso';
            $log->table = 'acessos';
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
        if(!Auth::user()->perfil->acessos_del){
            return response()->json('Não Autorizado', 401);
        }
        $data = Acesso::find($id);
         
         if($data->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Acesso';
            $log->table = 'acessos';
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
