
@extends('layouts.main')

@section('main')
<div class="container-fluid container-padding">
    @if(Session::has('message.success'))
        <div class="alert alert-success alert-dismissible fade show">

            <strong>{!!Session::get('message.success')!!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::has('message.error'))
        <div class="alert alert-danger alert-dismissible fade show">

            <strong>{!!Session::get('message.error')!!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="jumbotron jumbotron-fluid w-100 text-center" style="margin-bottom: 0rem;">
        <h1 class="display-4">CONTACTO</h1>
    </div>
    <div class="row text-center justify-content-center deleteRowMargin" style="min-height: 450px; padding: 0px; width: 100%;">
        <div class="col-6" style="align-self: center;">
            <h2>¿Quienes somos?</h2>
            <p class="pt-3">
               <b>TODO SOBRE MANGAS</b> es una editorial dedicada a la venta y distrubición de arte literario en Argentina.
                Trabajamos principalmente con IVREA una de las mayores editoriales del país, así como con proveedores del exterior, pudiendo ofrecer una gran variedad de productos dentro de nuestro catálogo.
            </p>
        </div>
        <div class="col-6 bg-nosotros">
        </div>
    </div>
    <div class="row text-center justify-content-center deleteRowMargin" style="min-height: 450px;">
        <div class="col-6 bg-manga3">
        </div>
        <div class="col-6" style="align-self: center;">
            <i class="fa fa-plus-square"  style="font-size: 75px;"></i>
            <br>
            <p class="pt-3">
                <h2>¿Desea comunicarse con nosotros?</h2>
                <p class="pt-3">
                    En caso de tener alguna duda o consulta, puede enviarnos un mail a la siguiente casilla: <b>todosobremangas@gmail.com</b>
                </p>
            </p>
        </div>
    </div>
</div>

@endsection
