@extends('layouts.admin')

@section('title', 'Pantalla Ver Pedidos del Usuario: ' . $user->name)

@section('main')
    <div class="container container-padding">
        @if (Session::has('message.success'))
            <div class="alert alert-success alert-dismissible fade show text-center">

                <strong>{!! Session::get('message.success') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (Session::has('message.error'))
            <div class="alert alert-danger alert-dismissible fade show text-center">

                <strong>{!! Session::get('message.error') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h2 class="w-100 text-center my-5 textBreak">Pedidos del Usuario: {{ $user->name }} </h2>
        @if($orders->isNotEmpty())
        @foreach ($orders as $order)
            <div class="row   rounded border border-secondary bg-light my-2">
                <div class="col-5  p-4">
                    <b>Datos del Pedido</b>
                    <div class="m-2 p-4">
                        <dl>
                            <div class="d-flex p-2">
                                <dd class="mr-2">Nro Order:</dd>
                                <dt class="textBreak">{{ $order->id }}</dt>
                            </div>
                            <div class="d-flex p-2">
                                <dd class="mr-2">Nombre:</dd>
                                <dt class="textBreak">{{ $order->user->name }}</dt>
                            </div>
                            <div class="d-flex p-2">
                                <dd class="mr-2">Email:</dd>
                                <dt>{{ $order->user->email }}</dt>
                            </div>
                            <div class="d-flex p-2">
                                <dd class="mr-2">Fecha:</dd>
                                <dt>{{ $order->created_at->format(__('dates.format')) }}</dt>
                            </div>
                            <div class="d-flex p-2">
                                <dd class="mr-2">Estado:</dd>
                                <dt>{{ $order->status }}</dt>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="col-7 p-4">
                    <b>Datos del Producto</b>
                    <div class="row">
                        <div class="col-5 p-4">
                            <dl class="py-3">
                                <div class="d-flex">
                                    <dd class="mr-2">Título:</dd>
                                    <dt class="textBreak">{{ $order->product->detail }}</dt>
                                </div>
                                <div class="d-flex">
                                    <dd class="mr-2">Precio:</dd>
                                    <dt>$ {{ $order->product->price }}</dt>
                                </div>
                                <div class="d-flex">
                                    <dd class="mr-2">Fecha:</dd>
                                    <dt>{{ $order->product->created_at->format(__('dates.format')) }}</dt>
                                </div>
                                <div class="d-flex">
                                    <dd class="mr-2 d-none">Categorías:</dd>
                                    <dt class="pb-4">
                                        @forelse ($order->product->genres  as $genre)
                                        <span class="badge bg-info text-white">{{$genre->name}}</span>
                                        @empty
                                        <span class="badge bg-secondary text-white">Sin genero</span>
                                        @endforelse
                                    </dt>
                                </div>
                            </dl>
                        </div>
                        <div class="col-4">
                            <img
                            src=" {{ url('images/'.$order->product->image) }} "
                            alt=" {{ $order->product->detail }} "
                            class=".img-fluid"
                            style="width: 100%"
                            >
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @else
        <div class="text-center p-5">
            <strong>EL USUARIO NO TIENE NIGÚN PEDIDO.</strong>
        </div>
        @endif
        <div class="d-flex">
            <a href="{{route('profile.index')}}" class="btn btn-secondary mx-1 my-1 w-100">VOLVER</a>
        </div>
    </div>
@endsection
