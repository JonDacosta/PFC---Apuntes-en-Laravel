<?php

namespace App\Http\Controllers;

use App\Models\Apunte;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $apuntes = Apunte::where('user_id', $perfil->user_id)->paginate(2);

        return view('perfiles.show', compact('perfil', 'apuntes') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {

        //Ejecuta el Policy
        $this->authorize('view', $perfil);
        //
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {

        //Ejecutar el policy
        $this->authorize('update', $perfil);

        //Validar
        $data = request()->validate([
            'nombre' => 'required',
            'biografia' => 'required'
        ]);
        //Si el usuario sube una imgen
        if($request['imagen']){
            //Obtener ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');


            //resize de la imagen        
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();
            
            $array_imagen = ['imagen' => $ruta_imagen];
        }

        
        

        //Asignar nombre
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        //Eliminar name de $data
        unset($data['nombre']);

        // Asignar Biografía e imagen
        

        //Guardar información
        auth()->user()->perfil()->update( array_merge(
            $data,
            $array_imagen ?? []
        ) );
        //Redireccionar
        return redirect()->action('ApunteController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
