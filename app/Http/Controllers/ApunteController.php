<?php

namespace App\Http\Controllers;

use App\Models\Apunte;
use App\Models\User;
use App\Models\ModuloApunte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

// use Illuminate\Support\Facades\Validator;

class ApunteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usuario = auth()->user();
        // auth()->user()->apuntes->dd();
        // $apuntes = auth()->user()->apuntes;

        //Apuntes con paginación
        $apuntes = Apunte::where('user_id', $usuario->id)->paginate(10);

        return view('apuntes.index')
                    ->with('apuntes', $apuntes)            
                    ->with('usuario', $usuario);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // DB::table('modulo_apunte')->get()->pluck('nombre', 'id')->dd();
        //Obtener los  modulos (sin modelo)
        // $modulos = DB::table('modulo_apuntes')->get()->pluck('nombre', 'id');

        //Obtener los modulos (con modelo)
        $modulos = ModuloApunte::all(['id', 'nombre']);

        return view('apuntes.create')->with('modulos', $modulos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd( $request['imagen']->store('upload-apuntes', 'public') );

        //Validaciones
        $data = $request->validate([
            'titulo' => 'required|min:5',
            'modulo' => 'required',
            'notas' => 'required',
            'imagen' => 'image'

        ]);
        //Obtener ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-apuntes', 'public');


        //resize de la imagen
        
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save(); 

        //almacenar en la base de datos (sin modelo).
        // DB::table('apuntes')->insert([
        //     'titulo' => $data['titulo'],
        //     'texto' => $data['notas'],
        //     'imagen' => $ruta_imagen, 
        //     'user_id' => Auth::user()->id,
        //     'modulo_id' => $data['modulo']

        // ]);

        //almacenar en la base de datos (con modelo).
            auth()->user()->apuntes()->create([
                'titulo' => $data['titulo'],
                'texto' => $data['notas'],
                'imagen' => $ruta_imagen, 
                // 'user_id' => Auth::user()->id,
                'modulo_id' => $data['modulo']
            ]);


        //Redireccionando
        return redirect()->action('\App\Http\Controllers\ApunteController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apunte  $apunte
     * @return \Illuminate\Http\Response
     */
    public function show(Apunte $apunte)
    {
        //Obtener si el usuario actual le gusta el apunte y esta autenticado
        $like = ( auth()->user() ) ? auth()->user()->meGusta->contains($apunte->id) :false;

        //Pasa la cantidad de likes a la vista
        $likes = $apunte->likes->count();


        return view('apuntes.show', compact('apunte', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apunte  $apunte
     * @return \Illuminate\Http\Response
     */
    public function edit(Apunte $apunte)
    {

        //Revisamos el Policy
        $this->authorize('view', $apunte);


        $modulos = ModuloApunte::all(['id', 'nombre']);

        // return view('apuntes.edit', compact('modulos'));
        return view('apuntes.edit', compact('modulos', 'apunte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apunte  $apunte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apunte $apunte)
    {
        //Revisamos el Policy
        $this->authorize('update', $apunte);
        //validación
        $data = $request->validate([
            'titulo' => 'required|min:5',
            'modulo' => 'required',
            'notas' => 'required'

        ]);

        //Asignar valores
        $apunte->titulo = $data['titulo'];
        $apunte->modulo_id = $data['modulo'];
        $apunte->texto = $data['notas'];

        //si el usuario sube nueva imagen
        if(request('imagen')){
            //Obtener ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-apuntes', 'public');

            //resize de la imagen
            
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();

            //Asignamos al objeto
            $apunte->imagen = $ruta_imagen;
        }

        $apunte->save();

        //redireccionar
        return redirect()->action('ApunteController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apunte  $apunte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apunte $apunte)
    {

        
        //Ejecutar el policy 
        $this->authorize('delete', $apunte);

        //Elimina el apunte
        $apunte->delete();

        return redirect()->action('ApunteController@index');
    }

    public function search(Request $request){

        
        $busqueda = $request->get('buscar');

        $apuntes = Apunte::where('titulo', 'like', '%' . $busqueda . '%' )->paginate(10);
        $apuntes->appends(['buscar' => $busqueda]);

        return view('busquedas.show', compact('apuntes', 'busqueda'));
    }
}
