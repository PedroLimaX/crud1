<?php

namespace App\Http\Controllers;

use App\Models\Entregable;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EntregableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos=DB::table('entregables')
        ->join('fases','entregables.fase_id','=','fases.id')
        ->select('entregables.*', 'fases.nombre_fase')
        ->orderby('entregables.id')
        ->get()
        ->toArray();
        return view('entregable.index', ['entregables'=>$datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('proyecto/fase/entregable.create');
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
        //$datosentregable = request()->all();

        $campos=[
            'nombre_entregable'=>'required|string|max:100',
            'descripcion_entregable'=>'required|string|max:10000',
            'requerimientos_entregable'=>'required|string|max:10000',
            'evidencia_entregable'=>'required|max:10000',
            'admin_id'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'evidencia_entregable.required'=>'La evidencia es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosentregable = request()->except('_token');
        if($request->hasFile('evidencia_entregable')){

            $datosentregable['evidencia_entregable']=$request->file('evidencia_entregable')->store('uploads', 'public');
        }
        Entregable::insert($datosentregable);
        //return response()->json($datosentregable);
        return redirect('proyecto/fase/entregable')->with('mensaje','entregable Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entregable  $entregable
     * @return \Illuminate\Http\Response
     */
    public function show(entregable $entregable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entregable  $entregable
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $docentes= DB::select('SELECT docentes.id, docentes.nombre_docente, docentes.apellidos_docente FROM docentes');
        $requerimientos=DB::select('SELECT requerimientos.*,  entregables.nombre_entregable FROM requerimientos
        INNER JOIN entregables ON requerimientos.entregable_id = entregables.id
        WHERE entregables.id= ?', [$id]);
        $entregable=Entregable::findOrFail($id);
        return view('proyecto/fase/entregable.edit', compact('entregable'), compact('requerimientos', 'docentes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entregable  $entregable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'nombre_entregable'=>'required|string|max:100',
            'descripcion_entregable'=>'required|string|max:10000',
            'requerimientos_entregable'=>'required|string|max:10000',
            'evidencia_entregable'=>'required|max:10000',
            'admin_id'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
if($request->hasFile('evidencia_entregable')){
    
     $campos=['evidencia_entregable'=>'required|max:10000',];
     $mensaje=[
        'evidencia_entregable.required'=>'La evidencia es requerida',
    ];
}

        $this->validate($request, $campos, $mensaje);
        //
        $datosentregable = request()->except('_token', '_method');

        if($request->hasFile('evidencia_entregable')){

            $entregable=Entregable::findOrFail($id);
            Storage::delete('public/'.$entregable->evidencia_entregable);
            $datosentregable['evidencia_entregable']=$request->file('evidencia_entregable')->store('uploads', 'public');
        }


        Entregable::where('id','=',$id)->update($datosentregable);


        //return view('entregable.edit', compact('entregable'));
        
        return redirect('proyecto/fase/entregable')->with('mensaje', 'Entregable Modificado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entregable  $entregable
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $entregable=Entregable::findOrFail($id);

        if(Storage::delete('public/'.$entregable->evidencia_entregable)){

            Entregable::destroy($id);

        }

        return redirect('proyecto/fase/entregable')->with('mensaje', 'Entregable Borrado Correctamente');
    }
}
