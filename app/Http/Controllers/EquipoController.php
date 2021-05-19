<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Proyecto;
use App\Models\Alumno;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos=DB::table('equipos')
        //->join('alumnos_equipos','equipos.id', '=','alumnos_equipos.equipo_id')
        //->join('alumnos','alumnos_equipos.alumno_id','=','alumnos.id')
        ->select('equipos.*')
        ->get()
        ->toArray();
        //echo '<pre>';
        //print_r($datos);
        //echo '</pre>';
        return view('equipo.index',  ['equipos'=>$datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('equipo.create');
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
        //$datosequipo = request()->all();

        $campos=[
            'nombre_equipo'=>'required|string|max:100',
            'eslogan_equipo'=>'required|string|max:100',
            'foto_equipo'=>'required|max:10000|mimes:jpeg,png,jpg',
            'proyecto_id'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'foto_equipo.required'=>'La foto es requerida'
        ];
        $this->validate($request, $campos, $mensaje);

        $datosequipo = request()->except('_token');
        if($request->hasFile('foto_equipo')){

            $datosequipo['foto_equipo']=$request->file('foto_equipo')->store('uploads', 'public');
        }
        Equipo::insert($datosequipo);
        //return response()->json($datosequipo);
        return redirect('equipo')->with('mensaje','Equipo Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show(Equipo $equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //$proyectos=Proyecto::all();
        
        $alumnos=DB::select('SELECT alumnos.nombre_alumno, alumnos.apellidos_alumno, alumnos.foto_alumno, carreras.siglas_carrera, alumnos_equipos.estatus from equipos
        INNER JOIN equipos_proyectos ON equipos.id = equipos_proyectos.equipo_id
        INNER JOIN proyectos ON equipos_proyectos.proyecto_id = proyectos.id
        INNER JOIN alumnos_equipos ON equipos.id = alumnos_equipos.equipo_id
        INNER JOIN alumnos ON alumnos_equipos.alumno_id = alumnos.id 
        INNER JOIN carreras ON alumnos.carrera_id = carreras.id 
        WHERE equipos.id = ?', [$id]);    
        
        $proyectos=DB::select('SELECT proyectos.id, proyectos.nombre_proyecto, proyectos.descripcion_proyecto FROM proyectos
        INNER JOIN equipos_proyectos ON proyectos.id = equipos_proyectos.proyecto_id
        INNER JOIN equipos ON equipos_proyectos.equipo_id = equipos.id
        WHERE equipos.id = ?',[$id]);

        $equipo=Equipo::findOrFail($id);
        return view('equipo.edit', compact('equipo'), compact('alumnos', 'proyectos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'nombre_equipo'=>'required|string|max:100',
            'eslogan_equipo'=>'required|string|max:100',
            'proyecto_id'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
if($request->hasFile('foto_equipo')){
    
     $campos=['foto_equipo'=>'required|max:10000|mimes:jpeg,png,jpg',];
     $mensaje=[
        'foto_equipo.required'=>'La foto es requerida',
    ];
}

        $this->validate($request, $campos, $mensaje);
        //
        $datosequipo = request()->except('_token', '_method');

        if($request->hasFile('foto_equipo')){

            $equipo=Equipo::findOrFail($id);
            Storage::delete('public/'.$equipo->foto_equipo);
            $datosequipo['foto_equipo']=$request->file('foto_equipo')->store('uploads', 'public');
        }


        Equipo::where('id','=',$id)->update($datosequipo);


        //return view('equipo.edit', compact('equipo'));
        
        return redirect('equipo')->with('mensaje', 'Equipo Modificado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $equipo=Equipo::findOrFail($id);

        if(Storage::delete('public/'.$equipo->foto_equipo)){

            Equipo::destroy($id);

        }

        return redirect('equipo')->with('mensaje', 'Equipo Borrado Correctamente');
    }
}
