<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Acesso;
use App\Models\AutoridadeAcesso;
use App\Models\Log;

class RelatoriosController extends Controller
{
    public function relAcessos(Request $request){

        $data = Acesso::where('data_hora', '>=', $request->data_hora_inicio)
        ->where('data_hora', '<=', $request->data_hora_fim)
        ->whereRelation('setor','orgao_id', $request->orgao_id);

        if($request->setor_id){
             $data->where('setor_id', $request->setor_id);
        }

        if($request->posto_id){
             $data->where('posto_id', $request->posto_id);
        }

        return $data->orderBy('data_hora')->get();
    }

    public function relAutoridadesAcessos(Request $request){

        $data = AutoridadeAcesso::where('data_hora_entrada', '>=', $request->data_hora_inicio)
        ->where('data_hora_entrada', '<=', $request->data_hora_fim)
        ->where('orgao_id', $request->orgao_id);    

        return $data->orderBy('data_hora_entrada')->get();
    }

}
