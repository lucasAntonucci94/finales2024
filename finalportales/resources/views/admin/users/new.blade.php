@extends('layouts.admin')

@section('title','Pantalla Editar Noticia')

@section('main')
<div class="container-fluid">
    <div class="row py-4 bg-light">
        <div class="col-12 text-center">
            <h1>Crear usuario</h1>
        </div>
        <div class="col-12">
            @if (Session::has('message.success'))
            <div class="alert alert-success alert-dismissible fade show">
                <strong class="text-center">{!! Session::get('message.success') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (Session::has('message.error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <strong class="text-center">{!! Session::get('message.error') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>
    <!-- error se crea por default via laravel por lo que al poner le any(), en caso de haber un error o no esta siempre existira como variable, pero vacia en caso de no catchear nada -->
    @if($errors->any())
    <div class="alert alert-danger text-center">Hay errores en los valores del formulario. Por favor, revise los campos y corrija el error.</div>
    @endif


<div class="container w-100  pb-5">
    <form class="row mx-auto border mt-3 mb-5 p-5" action="{{route('users.create')}}" method="post"  enctype="multipart/form-data">
        @csrf

        <div class="col-6">
            <div class="row d-flex">
                <div class="col-12 d-none">
                    <label for="id_user"  class="form-label">id</label>
                    <input  type="text" name="id_user" id="id_user" class="form-label w-100"
                    value="{{old('id', auth()->user()->id)}}"
                >
                </div>
                <div class="col-12">
                    <label for="name"  class="form-label my-2">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="ingrese su nombre" class="form-control w-100 @error('name') is-invalid @enderror"
                    @error('name') aria-describedby="error-name" @enderror
                    value="{{old('name')}}"
                    >
                    @error('name')
                        <div id="error-name" class="text-danger text-small"><p>{{ $message }}</p></div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="email"  class="form-label my-2">Email</label>
                    <input type="email" name="email" id="email" placeholder="ingrese su email"  class="form-control w-100 @error('email') is-invalid @enderror"
                    @error('email') aria-describedby="error-email" @enderror
                    value="{{old('email')}}"
                    >
                    @error('email')
                        <div id="error-email" class="text-danger text-small"><p>{{ $message }}</p></div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="password"  class="form-label my-2">Contraseña</label>
                    <input  type="password" name="password" id="password" placeholder="ingrese una contraseña"  class="form-control w-100 @error('password') is-invalid @enderror"
                    @error('error-password') aria-describedby="error-password" @enderror
                    value="{{old('password')}}"
                    >
                    @error('password')
                        <div id="error-password" class="text-danger text-small"><p>{{ $message }}</p></div>
                    @enderror
                </div>
                <div class="col-12 form-group my-2">
                        <strong>Roles:</strong>
                        <select name="id_role" class="form-control w-100 custom-select my-2">
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
        <div class="col-6">
            <div class="row d-flex">
                <div class="col-6">
                    <label for="image"  class="form-label w-100 my-2">Portada:</label>
                    <input type="file" name="image" id="image" class="form-label small">
                </div>
                <div id="preview" class="col-12 d-none py-2">
                    <p>Previsualización de la imagen</p>
                    <img id="preview-image" class="w-50" src="" alt="">
                </div>
            </div>
        </div>
        <div class="col-12 my-3 d-flex">
            <a href="{{url('admin/users')}}" class="btn btn-secondary w-100 mx-3">Cancelar</a>
            <button class="btn btn-success w-100  mx-3" type="submit">Aceptar</button>
        </div>
    </form>
</div>
</div>

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

    const emailInput = document.getElementById("email");
    const nameInput = document.getElementById("name");
    const passwordInput = document.getElementById("password");
   
    passwordInput.addEventListener("input", () => {
        const value = passwordInput.value;

        if (value.length < 6) {
            passwordInput.classList.add("is-invalid");
        } else {
            passwordInput.classList.remove("is-invalid");
            passwordInput.classList.add("is-valid");
        }   
    });
    emailInput.addEventListener("input", () => {
        const emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const value = emailInput.value;

        if (!emailRegex.test(value)) {
            emailInput.classList.add("is-invalid");
        } else {
            emailInput.classList.remove("is-invalid");
            emailInput.classList.add("is-valid");
        }   
    });
    nameInput.addEventListener("input", () => {
        const value = nameInput.value;

        if (value.length < 4) {
            nameInput.classList.add("is-invalid");
        } else {
            nameInput.classList.remove("is-invalid");
            nameInput.classList.add("is-valid");
        }   
    });
</script>
@endsection
