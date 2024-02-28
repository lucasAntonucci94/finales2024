<?php
/** @var Object|\Illuminate\Database\Eloquent\Collection $orders  */
/** @var User|\Illuminate\Database\Eloquent\Collection $user  */
?>
@extends('layouts.main')

@section('title','Pedidos del Usuario')

@section('main')
<div class="container-fluid bg-light">
    <div class="row py-4">
        <div class="col-12 text-center">
            <h1 class="display-4">Historial de Compras</h1>
        </div>
    </div>
</div>

<div class="container mt-4">
        <div class="row  w-100">
            <div class="col-11">
                <a class="btn btn-dark my-3 text-white" href="<?= url('profile');?>">Volver al perfil</a>
            </div>
        </div>
    @if($orders != null)
    <div class="row container pb-5">
        @foreach($orders as $order)
            <div class="col-2 col-md-4 col-lg-6">
                <div class="bg-white p-3 mb-3 d-flex flex-column">
                    <h4 class="mb-3">Resumen de la compra {{$order["order_id"]}}</h4>
                    <p class="mb-3">Estado de la compra: <span class="font-weight-bold">{{$order["status"]}}</span></p>
                    <ul class="list-group">
                        @foreach($order["items"] as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $item->quantity}} x {{ $item->product->detail }}</span>
                            <span class="badge badge-primary badge-pill">${{ ($item->product->price ?? 1 ) * $item->quantity }}</span>
                        </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                        Total
                        <span class="badge badge-success badge-pill">${{ $order["total"] }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="row">
            <div class="col-12 text-center">
                <p class="lead">Tu carrito de compras está vacío.</p>
            </div>
        </div>
    @endif
</div>

@endsection