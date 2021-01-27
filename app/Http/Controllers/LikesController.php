<?php

namespace App\Http\Controllers;

use App\Models\Apunte;
use Illuminate\Http\Request;

class LikesController extends Controller
{

    public function __contruct(){
        $this->middleware('auth');
    }

    public function update(Request $request, Apunte $apunte)
    {
        //Almacena los likes de un usuario al apunte
        return auth()->user()->meGusta()->toggle($apunte);
    }


}
