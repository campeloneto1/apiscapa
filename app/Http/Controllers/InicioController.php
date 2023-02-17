<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Acesso;
use Carbon\Carbon;
use DB;

class InicioController extends Controller
{
 
   public function acessosDia(){
        return Acesso::whereDate('data_hora', Carbon::now())->count();
   }

   public function acessosMes(){
        $now = Carbon::now();
        return Acesso::whereYear('data_hora', $now->year)->whereMonth('data_hora', $now->month)->count();
   }

   public function acessosPorDia(){
        $now = Carbon::now();
        return Acesso::select(DB::raw('day(data_hora) as dia'), DB::raw('count(id) as quant'))
        ->whereYear('data_hora', $now->year)
        ->whereMonth('data_hora', $now->month)
        ->groupBy(DB::raw('day(data_hora)'))
        ->get();
   }

    public function acessosPorSetor(){
        $now = Carbon::now();
        return Acesso::query()
        ->join('setores', 'setores.id', '=', 'acessos.setor_id')
        ->select('setores.nome', DB::raw('count(acessos.id) as quant'))
        ->whereDate('acessos.data_hora', Carbon::now())
        ->groupBy('setores.nome')
        ->orderBy(DB::raw('count(acessos.id)'), 'DESC')
        ->get();         
           
   }

}
