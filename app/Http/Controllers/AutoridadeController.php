<?php

namespace App\Http\Controllers;

use App\Models\Autoridade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class AutoridadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Autoridade::orderBy('nome')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->autoridades_acessos){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Autoridade;

        $data->cargo_id = $request->cargo_id;   
        $data->nome = $request->nome;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Autoridade';
            $log->table = 'autoridades';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Autoridade cadastrado com sucesso!', 200);
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
     * @param  \App\Models\Autoridade  $autoridade
     * @return \Illuminate\Http\Response
     */
    public function show(Autoridade $autoridade)
    {
        return $autoridade;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autoridade  $autoridade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autoridade $autoridade)
    {
        if(!Auth::user()->perfil->autoridades_acessos){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $autoridade;

        $autoridade->cargo_id = $request->cargo_id;  
        $autoridade->nome = $request->nome;   

        $autoridade->updated_by = Auth::id();      

        if($autoridade->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um aautoridade';
            $log->table = 'autoridades';
            $log->action = 2;
            $log->fk = $autoridade->id;
            $log->object = $autoridade;
            $log->object_old = $dataold;
            $log->save();
             return response()->json('autoridade editada com sucesso!', 200);
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
     * @param  \App\Models\Autoridade  $autoridade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autoridade $autoridade)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
         
        if($autoridade->delete()){
           $log = new Log;
           $log->user_id = Auth::id();
           $log->mensagem = 'Excluiu um autoridade';
           $log->table = 'autoridades';
           $log->action = 3;
           $log->fk = $autoridade->id;
           $log->object = $autoridade;
           $log->save();
           return response()->json('Autoridade excluído com sucesso!', 200);
         }else{
           $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
         }
    }
}
