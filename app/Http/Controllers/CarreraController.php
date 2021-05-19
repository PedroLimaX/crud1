<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['carreras']=Carrera::paginate(5);
        return view('carrera.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('carrera.create');
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
        //$datoscarrera = request()->all();

        $campos=[
            'nombre_carrera'=>'required|string|max:255',
            'siglas_carrera'=>'required|string|max:255'
            

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
        $this->validate($request, $campos, $mensaje);

        $datoscarrera = request()->except('_token');
        
        carrera::insert($datoscarrera);
        //return response()->json($datoscarrera);
        return redirect('carrera')->with('mensaje','Carrera Agregada Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function show(Carrera $carrera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $carrera=Carrera::findOrFail($id);

        return view('carrera.edit', compact('carrera'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'nombre_carrera'=>'required|string|max:255',
            'siglas_carrera'=>'required|string|max:255',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];


        $this->validate($request, $campos, $mensaje);
        //
        $datoscarrera = request()->except('_token', '_method');


        carrera::where('id','=',$id)->update($datoscarrera);


        //return view('carrera.edit', compact('carrera'));
        
        return redirect('carrera')->with('mensaje', 'Carrera Modificada Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $carrera=Carrera::findOrFail($id);

            Carrera::destroy($id);

        return redirect('carrera')->with('mensaje', 'Carrera Borrada Correctamente');
    }
}
