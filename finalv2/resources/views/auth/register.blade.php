@extends('layouts.main')

@section('title','Register')

@section('main')
<section>
    <div class="container-fluid  containerMain bg-register p-2 container-padding">
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
        <div class="row thisRow">
            <div class="col-8 text-white  p-5 rounded border border-light bg-dark2">
                <h1 class="text-center">Registrarse</h1>
                <p class="text-center py-1">Ingrese los datos de su nuevo usuario.</p>
                <form class="row mx-auto" action="{{route('auth.register')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <label for="name"  class="form-label w-100 my-3 font-weight-bold">Nombre</label>
                                <input type="text" name="name" placeholder="ingrese su nombre" id="name" class="form-control w-100 @error('name') is-invalid @enderror"
                                @error('name') aria-describedby="error-name" @enderror
                                value="{{old('name')}}"
                                >
                                @error('name')
                                    <div id="error-name" class="text-danger text-small"><p>{{ $message }}</p></div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="email"  class="form-label w-100 my-3 font-weight-bold">Email</label>
                                <input type="text" placeholder="ingrese su email" name="email" id="email" class="form-control w-100 @error('email') is-invalid @enderror"
                                @error('email') aria-describedby="error-email" @enderror
                                value="{{old('email')}}"
                                >
                                @error('email')
                                    <div id="error-email" class="text-danger text-small"><p>{{ $message }}</p></div>
                                @enderror
                            </div>
                            <div class="col-12 d-none">
                                <label for="id_role"  class="form-label w-100 my-3">id_role</label>
                                <input type="text" name="id_role" id="id_role" class="form-control w-100 "
                                value="2"
                                >
                            </div>
                            <div class="col-12 ">
                                <label for="password"  class="form-label my-3 font-weight-bold">Contraseña</label>
                                <input type="password" placeholder="ingrese una contraseña" name="password" id="password" class="form-control w-100 @error('password') is-invalid @enderror"
                                @error('password') aria-describedby="error-password" @enderror
                                value="{{old('password')}}"
                                >
                                @error('password')
                                    <div id="error-password" class="text-danger text-small"><p>{{ $message }}</p></div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-3 d-flex">
                        <button class="btn btn-info w-100 mx-3" type="submit"> <strong>ACEPTAR</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
