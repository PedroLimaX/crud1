<h1>{{$modo}} Usuario</h1>

@if(count($errors)>0)

 <div class="alert alert-danger" role="alert">
 <ul>
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
 </ul>
 </div>
    
@endif



<label for="pic_user"></label>
<div class="">
    
    @if(isset($user->pic_user))
    <img class="img-thumbnail img-fluid" src="{{asset ('storage').'/'.$user->pic_user }}" width="200" alt="">
    @endif
    <input type="file" class="form-control-file" name="pic_user" value="" id="pic_user">
   
    </div>
    <br>
    <div class="form-group">
<label for="name">Nombre</label>
    <input type="text" class="form-control" name="name"
    value="{{ isset($user->name)? $user->name:old('name') }}" id="name">

    </div>
    <div class="form-group">
    <label for="email">Correo</label>
    <input type="text" class="form-control" name="email"
    value="{{isset( $user->email)?$user->email:old('email') }}" id="email">

    
    </div>

    <label for="rol_user">Rol</label>
 <div class="form-group">
          <select class="form-control" id="rol_id">
            @foreach($roles as $rol)
              <option name="rol_id" id="rol_id" value="{{$rol->id}}"
                @if($user->rol_user==$rol->id) selected @endif>
                {{ $rol->nombre_rol }}
              </option>
            @endforeach
          </select>
        </div>
    <input class="btn btn-primary"  type="submit" value="{{$modo}} Datos">

    
<a class="btn btn-light" href="{{url ('user/')}}">Regresar</a>