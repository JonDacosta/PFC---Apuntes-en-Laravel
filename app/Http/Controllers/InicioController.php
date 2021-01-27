<?php

namespace App\Http\Controllers;

use App\Models\Apunte;
use Illuminate\Support\Str;
use App\Models\ModuloApunte;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index(){

        //Mostrar los apuntes por cantidad de votos
        $votados = Apunte::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();

        


        //Obtener los últimos apuntes
        //oldest() para los mas antiguos
        $nuevos = Apunte::latest()->take(5)->get();


        //Obtener todos los modulos
        $modulosAll = ModuloApunte::all();

        // return $modulosAll;
        
        //Agrupar los apuntes por modulos
        $apuntes = [];

        foreach($modulosAll as $modulo){
            $apuntes[ Str::slug( $modulo->nombre) ][] = Apunte::where('modulo_id', $modulo->id )->take(3)->get();
        }

        
        

        return view('inicio.index', compact('nuevos', 'apuntes', 'votados'));
    }
}
