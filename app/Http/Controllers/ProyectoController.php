<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*$datos=DB::select('SELECT proyectos.*, administradores.nombre_admin, CAST((SUM(entregables.completo_entregable)/ COUNT(entregables.completo_entregable) *100) AS SIGNED) AS progreso
        FROM proyectos INNER JOIN fases ON entregables.fase_id = fases.id
        INNER JOIN fases ON fases.proyecto_id = proyectos.id
        INNER JOIN administradores ON proyectos.admin_id = administradores.id');*/
        $datos=DB::select('SELECT proyectos.*, administradores.nombre_admin FROM proyectos 
        INNER JOIN administradores ON proyectos.admin_id = administradores.id ORDER BY proyectos.id');
        return view('proyecto.index', ['proyectos'=>$datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('proyecto.create');
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
        //$datosproyecto = request()->all();

        $campos=[
            'nombre_proyecto'=>'required|string|max:100',
            'descripcion_proyecto'=>'required|string|max:10000',
            'evidencia_proyecto'=>'required|max:10000',
            'admin_id'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'evidencia_proyecto.required'=>'La evidencia es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosproyecto = request()->except('_token');
        if($request->hasFile('evidencia_proyecto')){

            $datosproyecto['evidencia_proyecto']=$request->file('evidencia_proyecto')->store('uploads', 'public');
        }
        Proyecto::insert($datosproyecto);
        //return response()->json($datosproyecto);
        return redirect('proyecto')->with('mensaje','Proyecto Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $recursos = DB::select('SELECT recursos.nombre_recurso, recursos_proyecto.cantidad_recurso,
        ROUND(recursos_proyecto.cantidad_recurso*recursos.costo_recurso, 2) AS costo_total FROM recursos_proyecto
        INNER JOIN recursos ON recursos_proyecto.recurso_id = recursos.id
        INNER JOIN proyectos ON recursos_proyecto.proyecto_id = proyectos.id
        WHERE proyectos.id = ?', [$id]);
        $progresos = DB::select('SELECT CAST((SUM(entregables.completo_entregable)/ COUNT(entregables.completo_entregable) *100) AS SIGNED)
        AS progreso FROM entregables 
        INNER JOIN fases ON entregables.fase_id = fases.id
        INNER JOIN proyectos ON fases.proyecto_id = proyectos.id
        WHERE proyectos.id = ?', [$id]);
        //echo '<pre>';
        //print_r($progresos);
        //echo '</pre>';
        $fases=DB::select('SELECT fases.* FROM fases
        INNER JOIN proyectos ON fases.proyecto_id = proyectos.id
        WHERE proyectos.id= ?', [$id]);
        $admins=DB::select('SELECT * FROM administradores
        INNER JOIN proyectos ON administradores.id = proyectos.admin_id WHERE proyectos.id = ?', [$id]);
        $proyecto=Proyecto::findOrFail($id);

        return view('proyecto.edit', compact('proyecto'), compact('admins','fases', 'progresos', 'recursos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'nombre_proyecto'=>'required|string|max:100',
            'descripcion_proyecto'=>'required|string|max:10000',
            'evidencia_proyecto'=>'required|max:10000',
            'admin_id'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
if($request->hasFile('evidencia_proyecto')){
    
     $campos=['evidencia_proyecto'=>'required|max:10000',];
     $mensaje=[
        'evidencia_proyecto.required'=>'La evidencia es requerida',
    ];
}

        $this->validate($request, $campos, $mensaje);
        //
        $datosproyecto = request()->except('_token', '_method');

        if($request->hasFile('evidencia_proyecto')){

            $proyecto=Proyecto::findOrFail($id);
            Storage::delete('public/'.$proyecto->evidencia_proyecto);
            $datosproyecto['evidencia_proyecto']=$request->file('evidencia_proyecto')->store('uploads', 'public');
        }


        Proyecto::where('id','=',$id)->update($datosproyecto);


        //return view('proyecto.edit', compact('proyecto'));
        
        return redirect('proyecto')->with('mensaje', 'Proyecto Modificado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $proyecto=Proyecto::findOrFail($id);

        if(Storage::delete('public/'.$proyecto->evidencia_proyecto)){

            Proyecto::destroy($id);

        }

        return redirect('proyecto')->with('mensaje', 'Proyecto Borrado Correctamente');
    }
}
