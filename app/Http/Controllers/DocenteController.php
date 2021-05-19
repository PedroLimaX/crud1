<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos=DB::table('docentes')
        ->join('carreras','docentes.carrera_id','=','carreras.id')
        ->select('docentes.*', 'carreras.siglas_carrera', 'carreras.nombre_carrera')
        ->orderby('docentes.id')
        ->get()
        ->toArray();
        //$datos=Docentes
        return view('docente.index', ['docentes'=>$datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('docente.create');
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
        //$datosdocente = request()->all();

        $campos=[
            'nombre_docente'=>'required|string|max:100',
            'apellidos_docente'=>'required|string|max:100',
            'correo_docente'=>'required|email',
            'telefono_docente'=>'required|string|max:100',
            'carrera_id'=>'required|string|max:100',
            'foto_docente'=>'required|max:10000|mimes:jpeg,png,jpg',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'foto_docente.required'=>'La foto es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosdocente = request()->except('_token');
        if($request->hasFile('foto_docente')){

            $datosdocente['foto_docente']=$request->file('foto_docente')->store('uploads', 'public');
        }
        Docente::insert($datosdocente);
        //return response()->json($datosdocente);
        return redirect('docente')->with('mensaje','Docente Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $carreras=DB::select('SELECT * FROM carreras');
        $docente=Docente::findOrFail($id);
        
        return view('docente.edit', compact('docente'), compact('carreras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'nombre_docente'=>'required|string|max:100',
            'apellidos_docente'=>'required|string|max:100',
            'correo_docente'=>'required|email',
            'telefono_docente'=>'required|string|max:100',
            'carrera_id'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
if($request->hasFile('foto_docente')){
    
     $campos=['foto_docente'=>'required|max:10000|mimes:jpeg,png,jpg',];
     $mensaje=[
        'foto_docente.required'=>'La foto es requerida',
    ];
}

        $this->validate($request, $campos, $mensaje);
        //
        $datosdocente = request()->except('_token', '_method');

        if($request->hasFile('foto_docente')){

            $docente=Docente::findOrFail($id);
            Storage::delete('public/'.$docente->foto_docente);
            $datosdocente['foto_docente']=$request->file('foto_docente')->store('uploads', 'public');
        }


        Docente::where('id','=',$id)->update($datosdocente);


        //return view('docente.edit', compact('docente'));
        
        return redirect('docente')->with('mensaje', 'Docente Modificado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $docente=Docente::findOrFail($id);

        if(Storage::delete('public/'.$docente->foto_docente)){

            Docente::destroy($id);

        }

        return redirect('docente')->with('mensaje', 'Docente Borrado Correctamente');
    }
}
