<?php

namespace App\Http\Controllers;

use App\Models\AutoridadeAcesso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use Carbon\Carbon;

class AutoridadeAcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AutoridadeAcesso::whereDate('data_hora_entrada', Carbon::now())->orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        if(!Auth::user()->perfil->autoridades_acessos_cad){
            return response()->json('Não Autorizado', 401);
        }

        $consulta = AutoridadeAcesso::where('autoridade_id', $request->autoridade_id)->whereDate('data_hora_entrada', Carbon::now())->whereNull('data_hora_saida')->limit(1)->orderBy('id', 'desc')->get();
        
        if(!empty($consulta[0])){
            if($consulta[0]->tipo == $request->tipo){
                $erro = "O acesso já foi registrado";
                $cod = 171;
                $resposta = ['erro' => $erro, 'cod' => $cod];
                return response()->json($resposta, 404);
            }
        }
        
        
        $data = new AutoridadeAcesso;

        $data->orgao_id = Auth::user()->orgao_id;
        $data->autoridade_id = $request->autoridade_id;   
        $data->data_hora_entrada = Carbon::now();   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Acesso de Autoridade';
            $log->table = 'autoridades_acessos';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Acesso cadastrado com sucesso!', 200);
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
     * @param  \App\Models\AutoridadeAcesso  $autoridades_acesso
     * @return \Illuminate\Http\Response
     */
    public function show(AutoridadeAcesso $autoridades_acesso)
    {
        return $autoridades_acesso;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AutoridadeAcesso  $autoridades_acesso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AutoridadeAcesso $autoridades_acesso)
    {
        if(!Auth::user()->perfil->autoridades_acessos_edt){
            return response()->json('Não Autorizado', 401);
        }    

        $dataold = $autoridades_acesso;

        $autoridades_acesso->autoridade_id = $request->autoridade_id;  

        $autoridades_acesso->updated_by = Auth::id();      

        if($autoridades_acesso->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um acesso de Autoridade';
            $log->table = 'autoridade_acessos';
            $log->action = 2;
            $log->fk = $autoridades_acesso->id;
            $log->object = $autoridades_acesso;
            $log->object_old = $dataold;
            $log->save();
             return response()->json('Acesso editado com sucesso!', 200);
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
     * @param  \App\Models\AutoridadeAcesso  $autoridades_acesso
     * @return \Illuminate\Http\Response
     */
    public function destroy(AutoridadeAcesso $autoridades_acesso)
    {
        if(!Auth::user()->perfil->autoridades_acessos_del){
            return response()->json('Não Autorizado', 401);
        }
         
        if($autoridades_acesso->delete()){
           $log = new Log;
           $log->user_id = Auth::id();
           $log->mensagem = 'Excluiu um acesso de Autoridade';
           $log->table = 'autoridades_cessos';
           $log->action = 3;
           $log->fk = $autoridades_acesso->id;
           $log->object = $autoridades_acesso;
           $log->save();
           return response()->json('Acesso excluído com sucesso!', 200);
         }else{
           $erro = "Não foi possivel realizar a exclusão!";
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
    public function saida(Request $request, AutoridadeAcesso $id)
    {
       
        if(!Auth::user()->perfil->autoridades_acessos_edt){
            return response()->json('Não Autorizado', 401);
        }  
        
        
        $dataold = $id;

        $id->data_hora_saida = Carbon::now();  
        $id->obs = $request->obs;      
        $id->updated_by = Auth::id();      

        if($id->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Registrou uma saída de Autoridade';
            $log->table = 'autoridade_acessos';
            $log->action = 2;
            $log->fk = $id->id;
            $log->object = $id;
            $log->object_old = $dataold;
            $log->save();
             return response()->json('Saída registrada com sucesso!', 200);
        }else{
            $erro = "Não foi possivel realizar a edição!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
        }
    }
}
