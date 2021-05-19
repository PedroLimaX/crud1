<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['users']=user::paginate(5);
        return view('user.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.create');
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
        //$datosuser = request()->all();

        $campos=[
            'name'=>'required|string|max:100',
            'email'=>'required|string|max:100',
            'rol_user'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'pic_user.required'=>'La foto es requerida'
        ];
        $this->validate($request, $campos, $mensaje);

        $datosuser = request()->except('_token');
        if($request->hasFile('pic_user')){

            $datosuser['pic_user']=$request->file('pic_user')->store('uploads', 'public');
        }
        user::insert($datosuser);
        //return response()->json($datosuser);
        return redirect('user')->with('mensaje','Usuario Agregado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $roles=DB::select('SELECT roles.id, roles.nombre_rol FROM roles');
        $user=user::findOrFail($id);

        return view('user.edit', compact('user'), compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'name'=>'required|string|max:100',
            'email'=>'required|string|max:100',
            'rol_user'=>'required|string|max:100',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
if($request->hasFile('pic_user')){
    
     $campos=['pic_user'=>'required|max:10000|mimes:jpeg,png,jpg',];
     $mensaje=[
        'pic_user.required'=>'La foto es requerida',
    ];
}

        $this->validate($request, $campos, $mensaje);
        //
        $datosuser = request()->except('_token', '_method');

        if($request->hasFile('pic_user')){

            $user=user::findOrFail($id);
            Storage::delete('public/'.$user->pic_user);
            $datosuser['pic_user']=$request->file('pic_user')->store('uploads', 'public');
        }


        user::where('id','=',$id)->update($datosuser);


        //return view('user.edit', compact('user'));
        
        return redirect('user')->with('mensaje', 'Usuario Modificado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $user=user::findOrFail($id);

        if(Storage::delete('public/'.$user->pic_user)){

            user::destroy($id);

        }

        return redirect('user')->with('mensaje', 'Usuario Borrado Correctamente');
    }
}
