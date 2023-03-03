<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Pessoa;
use App\Models\Evento;
use App\Models\EventoPessoa;
use App\Models\Log;
use Carbon\Carbon;

class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //return Pessoa::orderBy('nome')->get();
       
             return Pessoa::orderBy('nome')->get();
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkCpf(Request $request)
    {
       //return Pessoa::orderBy('nome')->get();    
        return Pessoa::where('cpf', $request->id)->get();        
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function whereEvento($id)
    {
       //return Pessoa::orderBy('nome')->get();    
        return Evento::whereDate('data_hora',  Carbon::now())->whereRelation('pessoas', 'pessoa_id', $id)->without('pessoas')->get();
        //return EventoPessoa::where('pessoa_id', $id)->whereHas('evento', function ($query) {
                //$query->whereDate('data_hora',  Carbon::now());
             //})->evento()->get();        
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

        if(!Auth::user()->perfil->pessoas_cad){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Pessoa;
        
        //$data->orgao_id = $request->orgao_id;   
        //$data->nivel_id = $request->nivel_id;   
        $data->sexo_id = $request->sexo_id;   
        $data->nome = $request->nome; 
        $data->cpf = $request->cpf; 
        $data->rg = $request->rg; 
        $data->uf_rg_id = $request->uf_rg_id; 
        $data->data_nascimento = $request->data_nascimento;   
        $data->telefone1 = $request->telefone1; 
        $data->telefone2 = $request->telefone2; 
        $data->email = $request->email; 
        $data->mae = $request->mae; 
        $data->pai = $request->pai; 
        $data->obs = $request->obs; 
        $data->foto = $request->foto; 
        $data->key = bcrypt($request->cpf); 

         $data->cep = $request->cep;
        $data->rua = $request->rua;
        $data->numero = $request->numero;
        $data->bairro = $request->bairro;
        $data->complemento = $request->complemento;
        $data->cidade_id = $request->cidade_id;

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Pessoa';
            $log->table = 'pessoas';
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
        return Pessoa::with('acessos')->find($id);
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
        if(!Auth::user()->perfil->pessoas_edt){
            return response()->json('Não Autorizado', 401);
        }
         $data = Pessoa::find($id);
        $dataold = $data;

        //$data->orgao_id = $request->orgao_id;   
        //$data->nivel_id = $request->nivel_id;   
        $data->sexo_id = $request->sexo_id;   
        $data->nome = $request->nome; 
        $data->cpf = $request->cpf; 
        $data->rg = $request->rg; 
        $data->uf_rg_id = $request->uf_rg_id; 
        $data->data_nascimento = $request->data_nascimento;   
        $data->telefone1 = $request->telefone1; 
        $data->telefone2 = $request->telefone2; 
        $data->email = $request->email; 
        $data->mae = $request->mae; 
        $data->pai = $request->pai; 
        $data->obs = $request->obs; 
        $data->key = bcrypt($request->cpf); 

         $data->cep = $request->cep;
        $data->rua = $request->rua;
        $data->numero = $request->numero;
        $data->bairro = $request->bairro;
        $data->complemento = $request->complemento;
        $data->cidade_id = $request->cidade_id;

        $data->updated_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Pessoa';
            $log->table = 'pessoas';
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
        if(!Auth::user()->perfil->pessoas_del){
            return response()->json('Não Autorizado', 401);
        }
         $data = Pessoa::find($id);
         Storage::delete($data->foto);
         if($data->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Pessoa';
            $log->table = 'pessoas';
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadFoto(Request $request)
    {
        //return $request->image;
        $image = $request->image;  // your base64 encoded
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = date('dmYHis').".".'jpg';

        File::put(storage_path(). '/app/public/' . $imageName, base64_decode($image));
        
        return response()->json($imageName, 200);
      
    }

/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function uploadFoto2(Request $request){  
        if ($request->hasFile('image')){
            $file      = $request->file('image');
          

            if($request->file('image')->getSize() > 1000000){
                 $erro = "Tamanho máximo permitido é 1mb!";
                $cod = 171;
                $resposta = ['erro' => $erro, 'cod' => $cod];
               return response()->json($resposta, 403);
            }

            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture   = date('dmYHis').".".$extension;
            $file->move(storage_path().'/app/public/', $picture);

            $data = Pessoa::find($request->id);
            $dataold = Pessoa::find($request->id);
            $data->foto =  $picture;

            if($data->save()){
                $log = new Log;
                $log->user_id = Auth::id();
                $log->mensagem = 'Editou foto de pessoa';
                $log->table = 'pessoas';
                $log->action = 2;
                $log->fk = $data->id;
                $log->object = $data;
                $log->object_old = $dataold;
                $log->save();
              return response()->json('Informação cadastrada com sucesso!', 200);
            }else{
                $erro = "Não foi possivel realizar a edição!";
                $cod = 171;
                $resposta = ['erro' => $erro, 'cod' => $cod];
               return response()->json($resposta, 404);
            }
        }else{
              $erro = "Não foi possivel realizar a edição!";
                $cod = 171;
                $resposta = ['erro' => $erro, 'cod' => $cod];
               return response()->json($resposta, 404);
        }
  
        
    }
}
