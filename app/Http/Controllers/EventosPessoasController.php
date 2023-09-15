<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\EventoPessoa;
use App\Models\Log;

class EventosPessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EventoPessoa::orderBy('id')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function presente($id)
    {
        $data = EventoPessoa::find($id);
        $dataold = $data;

        $data->presente = !$data->presente;

        $data->updated_by = Auth::id(); 

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Registrou presença de uma Pessoa no Evento';
            $log->table = 'eventos_pessoas';
            $log->action = 2;
            $log->fk = $data->id;
            $log->object = $data;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Presença registrada com sucesso!', 200);
        }else{
            $erro = "Não foi possivel registrar a presença!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
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

        if(!Auth::user()->perfil->eventos){
            return response()->json('Não Autorizado', 401);
        }
        try {
            DB::beginTransaction();
            foreach ($request->pessoas as $key => $value) {
                 $data = new EventoPessoa;

                $data->evento_id = $request->evento;     
                $data->pessoa_id = $value;   
                $data->presente = 0;   
                //$data->obs = $request->obs;   

                $data->created_by = Auth::id();  
                $data->save();
            
                $log = new Log;
                $log->user_id = Auth::id();
                $log->mensagem = "Cadastrou uma Pessoa no Evento p ".$value." e ".$request->evento;
                $log->table = 'eventos_pessoas';
                $log->action = 1;
                $log->fk = $data->id;
                $log->object = $data;
                $log->save();
            }    
        } catch (Throwable $e) {
            DB::rollback();
             $erro = "Não foi possivel realizar o cadastro!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
        }
        DB::commit();
        return response()->json('Pessoa cadastrada com sucesso!', 200);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return EventoPessoa::find($id);
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
        $data = EventoPessoa::find($id);
        $dataold = $data;

        $data->evento_id = $request->evento_id;     
        $data->pessoa_id = $request->pessoa_id;   

        $data->updated_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Pessoa no Evento';
            $log->table = 'eventos_pessoas';
            $log->action = 2;
            $log->fk = $data->id;
            $log->object = $data;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Pessoa editada com sucesso!', 200);
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
        $data = EventoPessoa::find($id);
         
         if($data->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Pessoa do Evento';
            $log->table = 'eventos_pessoas';
            $log->action = 3;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Pessoa excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
