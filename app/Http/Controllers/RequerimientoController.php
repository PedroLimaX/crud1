<?php

namespace App\Http\Controllers;

use App\Models\Requerimiento;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RequerimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos=DB::table('requerimientos')
        ->orderby('requerimientos.id')
        ->get()
        ->toArray();
        return view('requerimiento.index', ['requerimientos'=>$datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('proyecto/fase/entregable/requerimiento.create');
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
        //$datosrequerimiento = request()->all();

        $campos=[
            'nombre_requerimiento'=>'required|string|max:100',
            'descripcion_requerimiento'=>'required|string|max:10000',
            'requerimientos_requerimiento'=>'required|string|max:10000',
            'evidencia_requerimiento'=>'required|max:10000',
            'admin_id'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'evidencia_requerimiento.required'=>'La evidencia es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosrequerimiento = request()->except('_token');
        if($request->hasFile('evidencia_requerimiento')){

            $datosrequerimiento['evidencia_requerimiento']=$request->file('evidencia_requerimiento')->store('uploads', 'public');
        }
        Requerimiento::insert($datosrequerimiento);
        //return response()->json($datosrequerimiento);
        return redirect('proyecto/fase/entregable/requerimiento')->with('mensaje','Requerimiento Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function show(requerimiento $requerimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $requerimientos=DB::select('SELECT requerimientos.* FROM requerimientos
        WHERE requerimientos.id= ?', [$id]);
        $requerimiento=Requerimiento::findOrFail($id);
        return view('proyecto/fase/entregable/requerimiento.edit', compact('requerimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'nombre_requerimiento'=>'required|string|max:100',
            'descripcion_requerimiento'=>'required|string|max:10000',
            'requerimientos_requerimiento'=>'required|string|max:10000',
            'evidencia_requerimiento'=>'required|max:10000',
            'admin_id'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
if($request->hasFile('evidencia_requerimiento')){
    
     $campos=['evidencia_requerimiento'=>'required|max:10000',];
     $mensaje=[
        'evidencia_requerimiento.required'=>'La evidencia es requerida',
    ];
}

        $this->validate($request, $campos, $mensaje);
        //
        $datosrequerimiento = request()->except('_token', '_method');

        if($request->hasFile('evidencia_requerimiento')){

            $requerimiento=Requerimiento::findOrFail($id);
            Storage::delete('public/'.$requerimiento->evidencia_requerimiento);
            $datosrequerimiento['evidencia_requerimiento']=$request->file('evidencia_requerimiento')->store('uploads', 'public');
        }


        Requerimiento::where('id','=',$id)->update($datosrequerimiento);


        //return view('requerimiento.edit', compact('requerimiento'));
        
        return redirect('proyecto/fase/entregable/requerimiento')->with('mensaje', 'Requerimiento Modificado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $requerimiento=Requerimiento::findOrFail($id);

        if(Storage::delete('public/'.$requerimiento->evidencia_requerimiento)){

            Requerimiento::destroy($id);

        }

        return redirect('proyecto/fase/entregable/requerimiento')->with('mensaje', 'Requerimiento Borrado Correctamente');
    }
}
