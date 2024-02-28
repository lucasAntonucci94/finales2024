<?php
/** @var Object|\Illuminate\Database\Eloquent\Collection $items  */
/** @var float|int $total */
/** @var int $orderId */
?>
@extends('layouts.admin')

@section('title','Ver detalle de una orden')

@section('main')
<div class="container-fluid bg-light">
    <div class="row py-4">
        <div class="col-12 text-center">
            <h1 class="">Ver detalle de un pedido</h1>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row  w-100">
        <div class="col-11">
            <a class="btn btn-dark my-3 text-white" href="<?= url('admin/orders');?>">Volver</a>
        </div>
    </div>
    @if($items != null)
        <div class="row">
            <div class="col-lg-8">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    @if ($item->product->image && file_exists(public_path('images/'.$item->product->image)))
                                        <img src="{{ asset('images/'.$item->product->image) }}" alt="{{ $item->product->detail }}" class="img-thumbnail mr-3" style="max-width: 100px;">
                                    @endif
                                    <span>{{ $item->quantity }} x {{ $item->product->detail }}</span>
                                </div>
                            </td>
                            <td class="align-middle">${{ $item->product->price }}</td>
                            <td class="align-middle">${{ $item->product->price * $item->quantity }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
            </div>
            <div class="col-lg-4">
                <div class="bg-white p-3 mb-3">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                            Total
                            <span class="badge badge-success badge-pill">${{ $total }}</span>
                        </li>
                    </ul>
                </div>
            </div>
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