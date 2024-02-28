
@extends('layouts.main')

@section('main')
<div class="container-fluid text-center container-padding">

    <div class="jumbotron jumbotron-fluid w-100 text-center" style="margin-bottom: 0rem">
        <h1 class="display-4">TODO SOBRE MANGAS</h1>
        <p class="lead">Ofrecemos una gran variedad de mangas, y una sección con todas las últimas novedades.</p>
    </div>
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
    <div class="row text-center justify-content-between deleteRowMargin" style="min-height: 450px; padding: 0px; width: 100%;">
        <div class="col-6 bg-manga">

        </div>
        <div class="col-6" style="align-self: center;">
            <a class="nav-link text-dark" href="<?= url('products');?>">
                <i class="fa fa-book" style="font-size: 75px;"></i>
                <br>
                <p class="pt-3">
                    <b> PRODUCTOS </b>
                    <br>
                    <span>Podrás encontrar una gran variedad de estilos en nuestro catálogo de productos.</span>
                </p>
            </a>
        </div>
    </div>
    <div class="row text-center justify-content-between deleteRowMargin" style="min-height: 450px;">
        <div class="col-6" style="align-self: center;">
            <a class="nav-link text-dark" href="<?= url('news');?>">
                <i class="fa fa-plus-square"  style="font-size: 75px;"></i>
                <br>
                <p class="pt-3">
                    <b> NOVEDADES </b>
                    <br>
                    <span>No te pierdas de todas las ultimas novedades acerca de las animaciones que mas te gustan.</span>
                </p>
            </a>
        </div>
        <div class="col-6 bg-manga2">

        </div>
    </div>

</div>

@endsection
