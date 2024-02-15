@extends('layouts.childadmin')

@section('title','Pantalla Nueva Noticia')

@section('main')
<div class="container container-padding">
    @if(Session::has('message.success'))
        <div class="alert alert-success alert-dismissible fade show text-center">

            <strong>{!!Session::get('message.success')!!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::has('message.error'))
        <div class="alert alert-danger alert-dismissible fade show text-center">

            <strong>{!!Session::get('message.error')!!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <h2 class="w-100 text-center my-5">Crea un Usuario</h2>
    @if($errors->any())
        <div class="alert alert-danger">Hay errores en los valores del formulario. Por favor, revise los campos y corrija el error.</div>
    @endif
    <div class="container w-100 text-center ">
        <form class="row mx-auto" action="{{route('users.create')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-6">
                <div class="row d-flex">
                    <div class="col-12">
                        <label for="name"  class="form-label w-100 my-3">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control w-100 @error('name') is-invalid @enderror"
                        @error('name') aria-describedby="error-name" @enderror
                        value="{{old('name')}}"
                        >
                        @error('name')
                            <div id="error-name" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="email"  class="form-label w-100 my-3">Email</label>
                        <input type="text" name="email" id="email" class="form-control w-100 @error('email') is-invalid @enderror"
                        @error('email') aria-describedby="error-email" @enderror
                        value="{{old('email')}}"
                        >
                        @error('email')
                            <div id="error-email" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="password"  class="form-label w-100 my-3">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control w-100 @error('password') is-invalid @enderror"
                        @error('password') aria-describedby="error-password" @enderror
                        value="{{old('password')}}"
                        >
                        @error('password')
                            <div id="error-password" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>
                    <div class="col-12">
                    <div class="form-group w-100">
                        <strong>Roles:</strong>
                        <select name="id_role" class="form-control w-100 custom-select">
                          <option value="">Seleccione un Rol</option>
                          @foreach($roles as $role)
                            <option value="{{ $role->id_role }}" @if(old('id_role') == $role->id_role) selected @endif>{{ $role->name }}</option>
                          @endforeach
                        </select>
                        @error('id_role')
                            <div id="error-id_role" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
              <div class="col-12">
                    <label for="image"  class="form-label w-100 my-3">Portada</label>
                    <input type="file" name="image" id="image" class="form-label">
                </div>
                <div id="preview" class="col-12 d-none">
                    <p>Previsualización de la imagen</p>
                    <img id="preview-image" src="" alt="">
                </div>
            </div>
            <div class="col-12 my-3 d-flex">
                <a href="{{url('admin/users')}}" class="btn btn-secondary w-100 mx-3">Cancelar</a>
                <button class="btn btn-success w-100 mx-3" type="submit">Aceptar</button>
            </div>
            <div class="col-12 d-flex my-3">
            </div>
        </form>


</div>
<script>
    const fileInput = document.getElementById('image');
    const previewDiv = document.getElementById('preview');
    const previewImg = document.getElementById('preview-image');
    fileInput.addEventListener('change', function(){
        const freader = new FileReader();
        freader.addEventListener('load', function(){
            previewImg.src = freader.result;
            previewDiv.classList.remove('d-none');
        });
        freader.readAsDataURL(this.files[0]);
    });
</script>
@endsection
