<?php

namespace App\Http\Controllers;

use App\Models\Apunte;
use App\Models\ModuloApunte;
use Illuminate\Http\Request;

class ModulosController extends Controller
{
    public function show(ModuloApunte $moduloApunte) {
        
        
        $apuntes = Apunte::where('modulo_id', $moduloApunte->id)->paginate(3);

        return view('modulos.show', compact('apuntes', 'moduloApunte'));
    }
}
