<?php
// /** @var \App\Models\Order[]|\Illuminate\Database\Eloquent\Collection $items */
/** @var Object|\Illuminate\Database\Eloquent\Collection $items  */
/** @var \MercadoPago\Preference $preference */
/** @var float|int $total */
/** @var string $publicKey */
/** @var int $orderId */
?>
@extends('layouts.main')

@section('title','Carrito de Compras')

@section('main')
<!-- <div class="container-fluid bg-light">
    <div class="row py-4">
        <div class="col-12 text-center">
            <h1 class="display-4">Tu Carrito de Compras</h1>
        </div>
    </div>
</div> -->

<div class="container mt-4">
    @if($items != null)
        <div class="row">
            <div class="col-lg-8">
                <div class="row w-100 d-flex justify-content-between">
                    <a class="btn btn-dark my-3 ml-3 text-white" href="<?= url('products');?>">Agregar productos</a>
                        @auth
                            <div>
                                <form class=" m-1" action="{{route('orders.delete',['id'=>$items[0]->order_id,'backurl'=>'order.checkout'])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger my-3 text-white"><i class="fa fa-trash fa-lg"></i> Vaciar carrito</button>
                                </form>
                            </div>
                        @endauth
                </div>
                <table class="table table-striped table-bordered">
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
                    @foreach($items as $item)
                        <tr>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    @if ($item->product->image && file_exists(public_path('images/'.$item->product->image)))
                                        <img src="{{ asset('images/'.$item->product->image) }}" alt="{{ $item->product->detail }}" class="img-thumbnail mr-3" style="max-width: 100px;">
                                    @endif
                                    <span>{{ $item->product->detail }}</span>
                                </div>
                            </td>
                            <td class="align-middle text-center">
                            <form id="item-{{ $item->id }}-form" action="{{ route('orderItem.quantity.update') }}" method="POST">
                                @csrf
                                <select id="quantity_{{ $item->id }}" name="new_quantity" class="form-control quantity-select">
                                    @for ($i = 1; $i <= 100; $i++)
                                        <option value="{{ $i }}" @if ($i === $item->quantity) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                            </form>
                            </td>
                            <td class="align-middle">${{ $item->product->price }}</td>
                            <td class="align-middle">${{ $item->product->price * $item->quantity }}</td>
                            <td class="grid items-center gap-2 justify-content-around">
                                <a href="{{ route('order.products.show', ['id' => $item->product->id_product]) }}" class="btn btn-sm btn-info btn-xs hover:bg-blue-400"><i class="fa fa-eye fa-lg"></i> Ver</a>
                                @auth
                                <form action="{{ route('order.item.delete', ['id' => $item->id, 'backurl' => 'order.checkout']) }}" method="post" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-xs hover:bg-red-600"><i class="fa fa-trash fa-lg"></i> Eliminar</button>
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
                        @foreach($items as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>
                                {{ $item->quantity}} x {{ $item->product->detail }} 
                                </span>    
                                <span class="badge badge-primary badge-pill">${{ ($item->product->price ?? 1 ) * $item->quantity }}</span>
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
            <div class="col-12 ">
                <a class="btn btn-dark my-3 ml-3 text-white" href="<?= url('products');?>">Agregar productos</a>
            </div>
            <div class="col-12 text-center">
                <p class="lead">Tu carrito de compras está vacío.</p>
            </div>
        </div>
    @endif
</div>

@if($preference !== null)
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago('<?=$publicKey;?>');
    const bricksBuilder = mp.bricks().create("wallet", "mp-bricks",{
        initialization:{
            preferenceId: '<?=$preference->id;?>',
        }
    });
    const quantitySelects = document.querySelectorAll('.quantity-select');
    console.log(quantitySelects)
    quantitySelects.forEach(select => {
        select.addEventListener('change', function() {
            this.closest('form').submit(); 
        });
    });
</script>
@endif
@endsection