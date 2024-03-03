@extends('layouts.admin')

@section('title','ABM Pedidos')

@section('main')
<div class="container-fluid container-padding">
    <div class="row" style="margin: 0px">
        <div class="col-12 p-5 bg-pedidos text-center text-white d-flex justify-content-center align-items-center" >
            <h1 class="w-100 text-center my-5">ABM DE PEDIDOS</h1>
        </div>
        <div class="col-12">
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
        </div>
    </div>
    <div class="container">
    @auth
        <div class="row  w-100">
            <div class="col-12">
                <a class="btn btn-dark my-3 text-white" href="<?= url('admin/dashboard');?>">Volver al panel</a>
            </div>
        </div>
    @endauth
    <div class="d-flex justify-content-around align-items-center w-100">
        <h2 class="w-100 sr-only">Buscador</h2>
        <form action="{{ route('admin.orders.index') }}" method="get" class="d-flex py-3">
            <label class="form-label sr-only" for="q" >Nombre de usuario</label>
            <input
                id="q"
                class="form-control"
                type="search"
                name="q"
                placeholder="busqueda por nombre de usuario"
                style="width: 850px;"
                value={{ $q }}
                >
            <button class="btn btn-primary mx-2" type="submit">Buscar</button>
        </form>
    </div>
    @if($orders->isNotEmpty())
    <table class="table table-striped table-bordered w-100">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->status}}</td>
                    <td>{{$order->created_at->format(__('dates.format'))}}</td>
                    <td>{{$order->enabled ? 'SI' : 'NO'}}</td>
                    <td class="d-flex">
                        <a class="btn btn-info m-1" href="{{route('admin.orders.show', ['id'=> $order->id])}}">Ver</a>
                        @auth
                            <a class="btn btn-warning m-1" href="{{route('edit.form.order', ['id'=>$order->id])}}">Editar</a>
                            <div>
                                <form class=" m-1" action="{{route('orders.delete',['id'=>$order->id,'backurl'=>'admin.orders.index'])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$orders->links()}}
    @else
        <div class="row p-5 text-center">
            <div class="col-12">
                <strong>
                    NO HAY PEDIDOS PARA MOSTRAR
                </strong>
            </div>
            <div class="col-12">
                <small class="text-danger">Los pedidos serán creados al reservar un producto en el listado de productos Ruta:"products.index".</small>
            </div>
            <div class="col-12">
                <a class="btn btn-warning px-3 my-2 font-weight-bold "  href="<?= url('products');?>">Productos</a>
            </div>
        </div>
    @endif
    </div>
</div>
@endsection
