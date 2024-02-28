@extends('layouts.admin')

@section('title','Panel de Administrador')

@section('main')
<div class="container-fluid container-padding deleteRowMargin">
    <div class="jumbotron jumbotron-fluid w-100">
        <div class="container text-center">
        <h1 class="display-4">PANEL DE CONTROL</h1>
        <p class="lead">Desde aquí podrás ver pedidos, customizar el contenido de la web y sus usuarios.</p>
        </div>
    </div>
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
    <div class="container">
        <div class="row  justify-content-around pb-4" >
            <div class="col-5  m-4 p-5 bg-pedidos text-center text-white rounded d-flex justify-content-center align-items-center">
                <a class="nav-link text-white" href="<?= url('admin/orders');?>">
                    <i class="fa fa-book" style="font-size: 75px;"></i>
                    <br>
                    <p class="pt-4 text-uppercase font-weight-bold h4">
                        ABM PEDIDOS
                    </p>
                </a>
            </div>
            <div class="col-5 m-4 p-5 bg-abmproducts text-center text-white rounded d-flex justify-content-center align-items-center" style="height: 275px">
                <a class="nav-link text-white" href="<?= url('admin/products');?>">
                    <i class="fa fa-product-hunt"   style="font-size: 75px;"></i>
                    <br>
                    <p class="pt-4 text-uppercase font-weight-bold h4">
                        ABM PRODUCTOS
                    </p>
                </a>
            </div>
            <div class="col-5  m-4 p-5 bg-abmnoticias text-center text-white rounded d-flex justify-content-center align-items-center">
                <a class="nav-link text-white" href="<?= url('admin/news');?>">
                    <i class="fa fa-plus-square"  style="font-size: 75px;"></i>
                    <br>
                    <p class="pt-4 text-uppercase font-weight-bold h4">
                        ABM NOTICIAS
                    </p>
                </a>
            </div>
            <div class="col-5  m-4 p-5 bg-users text-center text-white rounded d-flex justify-content-center align-items-center">
                <a class="nav-link text-white" href="<?= url('admin/users');?>">
                    <i class="fa fa-user"  style="font-size: 75px;"></i>
                    <br>
                    <p class="pt-4 text-uppercase font-weight-bold h4">
                        ABM USUARIOS
                    </p>
                </a>
            </div>
            <div class="col-5  m-4 p-5 bg-statistics text-center text-white rounded d-flex justify-content-center align-items-center">
                <a class="nav-link text-white" href="<?= url('admin/statistics');?>">
                    <i class="fa fa-area-chart"  style="font-size: 75px;"></i>
                    <br>
                    <p class="pt-4 text-uppercase font-weight-bold h4">
                        Estadísticas
                    </p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
