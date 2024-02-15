@extends('layouts.main')

@section('title','Iniciar Sesión')

@section('main')

<section>
    <div class=" container-fluid  containerMain bg-login p-2 container-padding">
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
                    <h1 class="text-center">Iniciar Sesión</h1>
                    <p class="text-center py-1">Ingrese sus credenciales para acceder al sitio.</p>
                    <form action="{{route('auth.login')}}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label font-weight-bold">Email</label>
                        <input id="email" name="email" type="email" class="form-control" placeholder="ingrese su email">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label font-weight-bold">Contraseña</label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="ingrese su contraseña">
                    </div>
                    <button type="submit" class="btn btn-info w-100 font-weight-bold">INGRESAR</button>
                </form>
            </div>
        </div>
    </div>

</section>
@endsection
