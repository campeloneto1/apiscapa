<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Evento;
use App\Models\Log;


class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Evento::orderBy('data_hora', 'desc')->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->eventos){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Evento;

        $data->setor_id = $request->setor_id;     
        $data->nome = $request->nome;   
        $data->data_hora = $request->data_hora;   
        $data->obs = $request->obs;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Evento';
            $log->table = 'eventos';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Evento cadastrado com sucesso!', 200);
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
        return Evento::find($id);
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
        if(!Auth::user()->perfil->eventos){
            return response()->json('Não Autorizado', 401);
        }
        $data = Evento::find($id);
        $dataold = $data;

        $data->setor_id = $request->setor_id;     
        $data->nome = $request->nome;   
        $data->data_hora = $request->data_hora;   
        $data->obs = $request->obs;    

        $data->updated_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Evento';
            $log->table = 'eventos';
            $log->action = 2;
            $log->fk = $data->id;
            $log->object = $data;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Evento editado com sucesso!', 200);
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
         if(!Auth::user()->perfil->eventos){
            return response()->json('Não Autorizado', 401);
        }
        $data = Evento::find($id);
         
         if($data->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Evento';
            $log->table = 'eventos';
            $log->action = 3;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Evento excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
