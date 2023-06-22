<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Acesso;
use App\Models\Evento;
use Carbon\Carbon;
use DB;

class InicioController extends Controller
{
 
   public function acessosDia(){
          $user = Auth::user();
        if($user->perfil->administrador){
             return Acesso::whereDate('data_hora', Carbon::now())->count();
        }else{ 
          return Acesso::whereDate('data_hora', Carbon::now())->whereRelation('setor','orgao_id', $user->orgao_id)->count();
            //return Acesso::whereDate('data_hora', $data)->whereRelation('setor','orgao_id', $user->orgao_id)->orderBy('id', 'desc')->get();
        }        
   }

   public function acessosMes(){
        $now = Carbon::now();
        
         $user = Auth::user();
        if($user->perfil->administrador){
             return Acesso::whereYear('data_hora', $now->year)->whereMonth('data_hora', $now->month)->count();
        }else{ 
          return Acesso::whereYear('data_hora', $now->year)->whereMonth('data_hora', $now->month)->whereRelation('setor','orgao_id', $user->orgao_id)->count();
        }      
   }

   public function acessosPorDia(){
        $now = Carbon::now();
        return Acesso::select(DB::raw('day(data_hora) as dia'), DB::raw('count(id) as quant'))
        ->whereYear('data_hora', $now->year)
        ->whereMonth('data_hora', $now->month)
        ->groupBy(DB::raw('day(data_hora)'))
        ->get();
   }

   public function acessosPorMes(){
        $now = Carbon::now();
        return Acesso::select(DB::raw('month(data_hora) as mes'), DB::raw('count(id) as quant'))
        ->whereYear('data_hora', $now->year)
        ->groupBy(DB::raw('month(data_hora)'))
        ->get();
   }

    public function acessosPorSetor(){
        $now = Carbon::now();
        $user = Auth::user();
        if($user->perfil->administrador){
            return Acesso::query()
             ->join('setores', 'setores.id', '=', 'acessos.setor_id')
             ->select('setores.nome', DB::raw('count(acessos.id) as quant'))
             ->whereDate('acessos.data_hora', Carbon::now())
             ->groupBy('setores.nome')
             ->orderBy(DB::raw('count(acessos.id)'), 'DESC')
             ->orderBy('setores.nome', 'ASC')
             ->get();   
        }else{ 
          return Acesso::query()
             ->join('setores', 'setores.id', '=', 'acessos.setor_id')
             ->select('setores.nome', DB::raw('count(acessos.id) as quant'))
             ->whereDate('acessos.data_hora', Carbon::now())
             ->where('setores.orgao_id', $user->orgao_id)
             ->groupBy('setores.nome')
             ->orderBy(DB::raw('count(acessos.id)'), 'DESC')
             ->orderBy('setores.nome', 'ASC')
             ->get();   
          //return Acesso::whereYear('data_hora', $now->year)->whereMonth('data_hora', $now->month)->whereRelation('setor','orgao_id', $user->orgao_id)->count();
        }    
   }

    public function proximosEventos(){

        $hj = Carbon::now();
        //return $hj->addDays(2);
        $user = Auth::user();
        if($user->perfil->administrador){
            return Evento::whereDate('data_hora', '>', $hj->subDays(1))
            ->whereDate('data_hora', '<=', $hj->addDays(2))
            ->orderBy('data_hora')
            ->get();
        }else{ 
            return Evento::whereDate('data_hora', '>', $hj->subDays(1))
            ->whereDate('data_hora', '<=', $hj->addDays(2))
            ->whereRelation('setor', 'orgao_id', $user->orgao_id)
            ->orderBy('data_hora')
            ->get();
        }  
        
   }

}
