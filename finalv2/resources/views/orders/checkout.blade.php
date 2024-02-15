<?php
/** @var \App\Models\Order[]|\Illuminate\Database\Eloquent\Collection $orders */
/** @var \MercadoPago\Preference $preference */
/** @var float|int $total */
/** @var string $publicKey */
?>
@extends('layouts.childmain')

@section('title','Carrito de Compras')

@section('main')
<!-- <div class="container-fluid container-padding">
    <div class="row" style="margin: 0;">
        <div class="col-12 p-5 bg-pedidos text-center text-white d-flex justify-content-center align-items-center">
            <h1 class="w-100 text-center my-5">Carrito de Compras</h1>
        </div>
        <div class="col-12">
            @if(Session::has('message.success') || Session::has('message.error'))
                @php
                    $messageType = Session::has('message.success') ? 'success' : 'error';
                    $message = Session::get('message.' . $messageType);
                @endphp
                <div class="alert alert-{{ $messageType }} alert-dismissible fade show text-center" role="alert">
                    <strong>{!! $message !!}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="container">
    @if($orders->isNotEmpty())
        <table class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            <div class="d-flex justify-content-start">
                                @if ($order->product->image && file_exists(public_path('images/'.$order->product->image)))
                                    @php
                                        [$w, $h, $type, $attrs] = getimagesize(public_path('images/'.$order->product->image));
                                    @endphp
                                    <img src="{{ asset('images/'.$order->product->image) }}" alt="{{ $order->product->detail }}" {!! $attrs !!} class="img-fluid w-25 h-25">
                                @endif
                            </div>
                            <p>{{ $order->product->detail }}</p>
                        </td>
                        <td>{{ $order->quantity }}</td>
                        <td>${{ $order->product->price }}</td>
                        <td class="d-flex justify-content-center">
                            <a class="btn btn-info m-1" href="{{ route('admin.orders.show', ['id'=> $order->id]) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            @auth
                                <div>
                                    <form class="m-1" action="{{ route('orders.delete',['id'=>$order->id,'backurl'=>'admin.orders.index']) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>TOTAL: ${{ $total }}</p>
    
<div id="mp-bricks"></div>

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
</div> -->

<div class="container-fluid bg-light">
    <div class="row py-4">
        <div class="col-12 text-center">
            <h1 class="display-4">Tu Carrito de Compras</h1>
        </div>
    </div>
</div>

<div class="container mt-4">
    @if($orders->isNotEmpty())
        <div class="row">
            <div class="col-lg-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Total</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        @if ($order->product->image && file_exists(public_path('images/'.$order->product->image)))
                                            <img src="{{ asset('images/'.$order->product->image) }}" alt="{{ $order->product->detail }}" class="img-thumbnail mr-3" style="max-width: 100px;">
                                        @endif
                                        <span>{{ $order->product->detail }}</span>
                                    </div>
                                </td>
                                <td class="align-middle">{{ $order->quantity }}</td>
                                <td class="align-middle">${{ $order->product->price }}</td>
                                <td class="align-middle">${{ $order->quantity * $order->product->price }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.orders.show', ['id'=> $order->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Ver Detalles</a>
                                    @auth
                                        <form action="{{ route('orders.delete',['id'=>$order->id,'backurl'=>'admin.orders.index']) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                        </form>
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="bg-white p-3 mb-3">
                    <h4 class="mb-3">Resumen de la Compra</h4>
                    <ul class="list-group">
                        @foreach($orders as $order)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $order->product->detail }}
                                <span class="badge badge-primary badge-pill">${{ 1 * $order->product->price }}</span>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                            Total
                            <span class="badge badge-success badge-pill">${{ $total }}</span>
                        </li>
                    </ul>
                    <div id="mp-bricks"></div>
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

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago('<?=$publicKey;?>');
    const bricksBuilder = mp.bricks().create("wallet", "mp-bricks",{
        initialization:{
            preferenceId: '<?=$preference->id;?>',
        }
    });
</script>