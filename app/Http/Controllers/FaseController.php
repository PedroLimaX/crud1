<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos=DB::table('fases')
        ->join('proyectos','fases.proyecto_id','=','proyectos.id')
        ->select('fases.*', 'proyectos.nombre_proyecto')
        ->orderby('fases.id')
        ->get()
        ->toArray();
        return view('fase.index', ['fases'=>$datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('proyecto/fase.create');
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
        //$datosfase = request()->all();

        $campos=[
            'nombre_fase'=>'required|string|max:100',
            'descripcion_fase'=>'required|string|max:10000',
            'requerimientos_fase'=>'required|string|max:10000',
            'evidencia_fase'=>'required|max:10000',
            'admin_id'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'evidencia_fase.required'=>'La evidencia es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosfase = request()->except('_token');
        if($request->hasFile('evidencia_fase')){

            $datosfase['evidencia_fase']=$request->file('evidencia_fase')->store('uploads', 'public');
        }
        Fase::insert($datosfase);
        //return response()->json($datosfase);
        return redirect('proyecto/fase')->with('mensaje','Fase Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function show(Fase $fase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $entregables=DB::select('SELECT entregables.*, fases.*, proyectos.nombre_proyecto FROM entregables
        INNER JOIN fases ON entregables.fase_id = fases.id
        Inner JOIN proyectos ON fases.proyecto_id = proyectos.id
        WHERE fases.id= ?', [$id]);
        $fase=Fase::findOrFail($id);
        return view('proyecto/fase.edit', compact('fase'), compact('entregables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'nombre_fase'=>'required|string|max:100',
            'descripcion_fase'=>'required|string|max:10000',
            'requerimientos_fase'=>'required|string|max:10000',
            'evidencia_fase'=>'required|max:10000',
            'admin_id'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
if($request->hasFile('evidencia_fase')){
    
     $campos=['evidencia_fase'=>'required|max:10000',];
     $mensaje=[
        'evidencia_fase.required'=>'La evidencia es requerida',
    ];
}

        $this->validate($request, $campos, $mensaje);
        //
        $datosfase = request()->except('_token', '_method');

        if($request->hasFile('evidencia_fase')){

            $fase=Fase::findOrFail($id);
            Storage::delete('public/'.$fase->evidencia_fase);
            $datosfase['evidencia_fase']=$request->file('evidencia_fase')->store('uploads', 'public');
        }


        Fase::where('id','=',$id)->update($datosfase);


        //return view('fase.edit', compact('fase'));
        
        return redirect('proyecto/fase')->with('mensaje', 'Fase Modificado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $fase=Fase::findOrFail($id);

        if(Storage::delete('public/'.$fase->evidencia_fase)){

            Fase::destroy($id);

        }

        return redirect('proyecto/fase')->with('mensaje', 'Fase Borrado Correctamente');
    }
}
