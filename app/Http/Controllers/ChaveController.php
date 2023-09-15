<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Chave;
use App\Models\Log;
use DB;


class ChaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Chave::orderBy('nome')->get();
        $user = Auth::user();
        if($user->perfil->administrador){
             return Chave::whereNull('data_hora_devolucao')
             ->orWhere(function (Builder $query) {
                $query->whereDate('data_hora_entrega', Carbon::now());
              })
             ->orderBy('id', 'desc')->get();
        }else{ 
            return Chave::where(function (Builder $query)  use ($user){
                $query->whereRelation('setor','orgao_id', $user->orgao_id)
                    ->whereDate('data_hora_entrega', Carbon::now());
              })
            ->orWhere(function (Builder $query) use ($user){
                $query->whereRelation('setor','orgao_id', $user->orgao_id)
                    ->whereNUll('data_hora_devolucao');
              })
            ->orderBy('id', 'desc')->get();
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
        if(!Auth::user()->perfil->chaves_cad){
            return response()->json('Não Autorizado', 401);
        }
        $user = Auth::user();

        try {
            DB::beginTransaction();
            foreach ($request->setor_id as $key => $value) {
                $chave = Chave::where('setor_id', $value)->whereRelation('setor','orgao_id', $user->orgao_id)->whereNull('data_hora_devolucao')->get();

                if(empty($chave[0])){
                     $data = new Chave;

                    $data->setor_id = $value;     
                    $data->funcionario_entrega_id = $request->funcionario_entrega_id;   
                    $data->data_hora_entrega = Carbon::now(); 
                    $data->obs = $request->obs;   

                    $data->created_by = Auth::id();      
                    $data->save();
                
                    $log = new Log;
                    $log->user_id = Auth::id();
                    $log->mensagem = 'Cadastrou uma entrega de Chave';
                    $log->table = 'chaves';
                    $log->action = 1;
                    $log->fk = $data->id;
                    $log->object = $data;
                    $log->save();
                }

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



       /*
        $chave = Chave::where('setor_id', $request->setor_id)->whereRelation('setor','orgao_id', $user->orgao_id)->whereNull('data_hora_devolucao')->get();

        if(!empty($chave[0])){
            $erro = "Chave já foi emprestada!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
        }

        $data = new Chave;

        $data->setor_id = $request->setor_id;     
        $data->funcionario_entrega_id = $request->funcionario_entrega_id;   
        $data->data_hora_entrega = Carbon::now(); 
        $data->obs = $request->obs;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma entrega de Chave';
            $log->table = 'chaves';
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
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chave  $chave
     * @return \Illuminate\Http\Response
     */
    public function show(Chave $chafe)
    {
        return $chafe;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chave  $chave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chave $chafe)
    {
        if(!Auth::user()->perfil->chaves_edt){
            return response()->json('Não Autorizado', 401);
        }


        $dataold = $chafe;

        $chafe->setor_id = $request->setor_id;   
        $chafe->funcionario_entrega_id = $request->funcionario_entrega_id;   
        $chafe->obs = $request->obs;   
        
        $chafe->updated_by = Auth::id();      

        if($chafe->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma entrega de Chave';
            $log->table = 'chaves';
            $log->action = 2;
            $log->fk = $chafe->id;
            $log->object = $chafe;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chave  $chave
     * @return \Illuminate\Http\Response
     */
    public function receber(Request $request, Chave $chafe)
    {
        if(!Auth::user()->perfil->chaves_edt){
            return response()->json('Não Autorizado', 401);
        }

        //return $chafe;

        $dataold = $chafe;

        $chafe->funcionario_devolucao_id = $request->funcionario_devolucao_id;   
        $chafe->data_hora_devolucao = Carbon::now(); 
        $chafe->obs = $request->obs;   
        
        $chafe->updated_by = Auth::id();      

        if($chafe->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Recebeu uma Chave';
            $log->table = 'chaves';
            $log->action = 2;
            $log->fk = $chafe->id;
            $log->object = $chafe;
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
     * @param  \App\Models\Chave  $chave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chave $chafe)
    {
         if(!Auth::user()->perfil->chaves_del){
            return response()->json('Não Autorizado', 401);
        }
        
         
         if($chafe->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma entrega de chave';
            $log->table = 'chaves';
            $log->action = 3;
            $log->fk = $chafe->id;
            $log->object = $chafe;
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
