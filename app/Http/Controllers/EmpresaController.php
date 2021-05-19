<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empresas']=Empresa::paginate(5);
        return view('empresa.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empresa.create');
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
        //$datosEmpresa = request()->all();

        $campos=[
            'nombre_empresa'=>'required|string|max:100',
            'gerente_empresa'=>'required|string|max:100',
            'correo_empresa'=>'required|email',
            'telefono_empresa'=>'required|string|max:100',
            'foto_empresa'=>'required|max:10000|mimes:jpeg,png,jpg',
            

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'foto_empresa.required'=>'La foto es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosEmpresa = request()->except('_token');
        if($request->hasFile('foto_empresa')){

            $datosEmpresa['foto_empresa']=$request->file('foto_empresa')->store('uploads', 'public');
        }
        Empresa::insert($datosEmpresa);
        //return response()->json($datosEmpresa);
        return redirect('empresa')->with('mensaje','Empresa Agregada Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $proyectos=DB::select('SELECT proyectos.nombre_proyecto, proyectos.descripcion_proyecto FROM proyectos
        INNER JOIN empresas_proyectos ON empresas_proyectos.proyecto_id = proyectos.id
        INNER JOIN empresas ON empresas_proyectos.empresa_id = empresas.id
        WHERE empresas.id = ?',[$id]);

        $empresa=Empresa::findOrFail($id);

        return view('empresa.edit', compact('empresa'), compact('proyectos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'nombre_empresa'=>'required|string|max:100',
            'gerente_empresa'=>'required|string|max:100',
            'correo_empresa'=>'required|email',
            'telefono_empresa'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
if($request->hasFile('foto_empresa')){
    
     $campos=['foto_empresa'=>'required|max:10000|mimes:jpeg,png,jpg',];
     $mensaje=[
        'foto_empresa.required'=>'La foto es requerida',
    ];
}

        $this->validate($request, $campos, $mensaje);
        //
        $datosEmpresa = request()->except('_token', '_method');

        if($request->hasFile('foto_empresa')){

            $empresa=Empresa::findOrFail($id);
            Storage::delete('public/'.$empresa->foto_empresa);
            $datosEmpresa['foto_empresa']=$request->file('foto_empresa')->store('uploads', 'public');
        }


        Empresa::where('id','=',$id)->update($datosEmpresa);


        //return view('empresa.edit', compact('Empresa'));
        
        return redirect('empresa')->with('mensaje', 'Empresa Modificada Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $empresa=Empresa::findOrFail($id);

        if(Storage::delete('public/'.$empresa->foto_empresa)){

            Empresa::destroy($id);

        }

        return redirect('empresa')->with('mensaje', 'Empresa Borrada Correctamente');
    }
}
