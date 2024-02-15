@extends('layouts.main')

@section('title', 'Pantalla Productos')

@section('main')
    <div class="container-fluid bg-light container-padding">

        <div class="bg-secondary d-flex justify-content-around align-items-center">
            <h2 class="w-100 text-center text-white py-5">Listado de productos</h2>

        </div>
        @if (Session::has('message.success'))
            <div class="alert text-center alert-success alert-dismissible fade show">

                <strong>{!! Session::get('message.success') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (Session::has('message.error'))
            <div class="alert text-center alert-danger alert-dismissible fade show">

                <strong>{!! Session::get('message.error') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="d-flex justify-content-around align-items-center w-100">
            <h2 class="w-100 sr-only">Buscador</h2>
            <form action="{{ route('products.index') }}" method="get" class="d-flex py-3">
                <label class="form-label sr-only" for="q">Titulo</label>
                <input id="q" class="form-control" type="search" name="q" placeholder="busqueda por titulo"
                    style="width: 850px;" value={{ $q }}>
                <button class="btn btn-primary mx-2" type="submit">Buscar</button>
            </form>
        </div>

        @if ($products->isNotEmpty())
            <div class="row d-flex justify-content-around align-items-center p-2 deleteRowMargin">
                @foreach ($products as $product)
                    <div class="col-2 rounded border-secondary text-center border m-4 p-2">
                        @if ($product->image != '' && file_exists('images/' . $product->image))
                            @php
                                [$w, $h, $type, $attrs] = getimagesize('images/' . $product->image);
                            @endphp
                            <img src=" {{ url('images/' . $product->image) }} " alt=" {{ $product->detail }} "
                                class=".img-fluid" style="max-width: 100%;">
                        @endif

                        <p class="pt-2 textBreak"> <b> {{ $product->detail }} </b></p>
                        @forelse ($product->genres  as $genre)
                            <span class="badge bg-secondary text-white">{{ $genre->name }}</span>
                        @empty
                            Sin genero
                        @endforelse
                        <div class="row pt-3 ">
                            <div class="col-5">
                                <p class="text-left textBreak">Precio: $ <b> {{ $product->price }} </b></p>
                            </div>
                            <div class="col-7">
                                <p class="text-right textBreak">Fecha:<b> {{ $product->date->format(__('dates.format')) }}
                                    </b></p>
                            </div>
                        </div>
                        @php
                            if (auth()->user() != null) {
                                $hasOrder = false;
                                foreach ($orders as $order) {
                                    if ($order->id_product == $product->id_product && $order->id_user == auth()->user()->id) {
                                        $hasOrder = true;
                                        $thisOrder = $order->id;
                                    }
                                }
                            }
                        @endphp

                        @if (auth()->user() != null)
                            @if ($hasOrder)
                                <form class=" m-1" action="{{route('orders.delete',['id'=>$thisOrder,'backurl'=>'products.index'])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100 text-white my-1">Cancelar Reserva</button>
                                </form>
                            @else
                                <form action="{{ route('order.create') }}" method="post" class="d-flex">
                                    @csrf
                                    <label class="form-label sr-only" for="id_user">user</label>
                                    <input id="id_user" class="form-control sr-only" type="text" name="id_user"
                                    value={{ auth()->user()->id }}>
                                    <label class="form-label sr-only" for="id_product">product</label>
                                    <input id="id_product" class="form-control sr-only" type="text" name="id_product"
                                        value={{ $product->id_product }}>
                                    <button class="btn btn-info w-100 text-white my-1" type="submit">
                                        Reservar
                                    </button>
                                </form>
                            @endif
                        @endif




                {{-- href="{{route('pedidos.create', ['id_product'=> $product->id_product,'id_user'=> auth()->user()->id])}}" --}}
                <a class="btn btn-secondary w-100 my-1"
                    href="{{ route('products.show', ['id' => $product->id_product]) }}">Ver</a>
            </div>
        @endforeach
    </div>
    </div>
@else
    <div class="text-center font-weight-bold p-5">NO HAY PRODUCTOS PARA MOSTRAR</div>
    @endif

@endsection
