<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class RecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['recursos']=Recurso::paginate(5);
        return view('recurso.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('recurso.create');
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
        //$datosrecurso = request()->all();

        $campos=[
            'nombre_recurso'=>'required|string|max:255',
            'detalles_recurso'=>'required|string|max:255',
            'estatus_recurso'=>'required|string|max:255',
            'cantidad_recurso'=>'required|string|max:255',
            'fecha_registro'=>'required|string|max:255'
            

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosrecurso = request()->except('_token');
        
        Recurso::insert($datosrecurso);
        //return response()->json($datosrecurso);
        return redirect('recurso')->with('mensaje','Recurso Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function show(recurso $recurso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $recurso=Recurso::findOrFail($id);

        return view('recurso.edit', compact('recurso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'nombre_recurso'=>'required|string|max:255',
            'detalles_recurso'=>'required|string|max:255',
            'estatus_recurso'=>'required|string|max:255',
            'cantidad_recurso'=>'required|string|max:255',
            'fecha_registro'=>'required|string|max:255'

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];


        $this->validate($request, $campos, $mensaje);
        //
        $datosrecurso = request()->except('_token', '_method');


        Recurso::where('id','=',$id)->update($datosrecurso);


        //return view('recurso.edit', compact('recurso'));
        
        return redirect('recurso')->with('mensaje', 'Recurso Modificado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $recurso=Recurso::findOrFail($id);

            Recurso::destroy($id);

        return redirect('recurso')->with('mensaje', 'Recurso Borrado Correctamente');
    }
}
