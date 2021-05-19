<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Equipo;
use App\Models\Carrera;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        $datos=DB::table('alumnos')
        ->join('carreras','alumnos.carrera_id','=','carreras.id')
        ->select('alumnos.*', 'carreras.siglas_carrera', )
        ->orderby('alumnos.id')
        ->get()
        ->toArray();
        //echo '<pre>';
        //print_r($datos);
        //echo '</pre>';
        //$datos=Alumno
        return view('alumno.index', ['alumnos'=>$datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $carreras=DB::select('SELECT carreras.id, carreras.nombre_carrera FROM carreras');
        return view('alumno.create',compact('carreras'));
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
        //$datosAlumno = request()->all();
        
        $campos=[
            'nombre_alumno'=>'required|string|max:255',
            'apellidos_alumno'=>'required|string|max:255',
            'correo_alumno'=>'required|email',
            'telefono_alumno'=>'required|string|max:255',
            'foto_alumno'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'foto_alumno.required'=>'La foto es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosAlumno = request()->except('_token');
        if($request->hasFile('foto_alumno')){
            $datosAlumno['foto_alumno']=$request->file('foto_alumno')->store('uploads', 'public');
        }
        Alumno::insert($datosAlumno);
        //return response()->json($datosAlumno);
        return redirect('alumno')->with('mensaje','Alumno Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $equipos=DB::select('SELECT * from equipos
        INNER JOIN alumnos_equipos ON equipos.id = alumnos_equipos.equipo_id
        INNER JOIN alumnos ON alumnos_equipos.alumno_id = alumnos.id where alumnos.id = ?', [$id]);

        $alumno=Alumno::findOrFail($id);

        $carreras=DB::select('SELECT carreras.id, carreras.nombre_carrera FROM carreras');
        //echo '<pre>';
        //print_r($equipos);
        //echo '</pre>';
        return view('alumno.edit', compact('alumno'), compact('carreras', 'equipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $carreras=DB::select('SELECT carreras.id, carreras.nombre_carrera FROM carreras');
        $campos=[
            'nombre_alumno'=>'required|string|max:100',
            'apellidos_alumno'=>'required|string|max:100',
            'correo_alumno'=>'required|email',
            'telefono_alumno'=>'required|string|max:100',
            'carrera_id'=>'required|string|max:11',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'carrera_id.required'=>'La carrera es requerida'
        ];
if($request->hasFile('foto_alumno')){
    
     $campos=['foto_alumno'=>'required|max:10000|mimes:jpeg,png,jpg',];
     $mensaje=[
        'foto_alumno.required'=>'La foto es requerida',
    ];
}

        $this->validate($request, $campos, $mensaje);
        //
        $datosAlumno = request()->except('_token', '_method');

        if($request->hasFile('foto_alumno')){

            $alumno=Alumno::findOrFail($id);
            Storage::delete('public/'.$alumno->foto_alumno);
            $datosAlumno['foto_alumno']=$request->file('foto_alumno')->store('uploads', 'public');
        }


        Alumno::where('id','=',$id)->update($datosAlumno);


        //return view('alumno.edit', compact('alumno'));
        
        return redirect('alumno')->with('mensaje', 'Alumno Modificado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $alumno=Alumno::findOrFail($id);

        if(Storage::delete('public/'.$alumno->foto_alumno)){

            Alumno::destroy($id);

        }

        return redirect('alumno')->with('mensaje', 'Alumno Borrado Correctamente');
    }
}
