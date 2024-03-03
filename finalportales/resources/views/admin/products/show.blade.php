@extends('layouts.main')

@section('title','Pantalla Ver Producto: '.$product->detail)

@section('main')
<div class="container container-padding">
    <div class="row">
        <div class="col-7 mt-4">

            <a href="{{url('admin/products')}}" class="btn btn-secondary my-2">VOLVER</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center align-items-start p-5">
        <div class="col-6"> 
            <div class="text-center">
            @if ($product->image != '' && file_exists('images/'.$product->image))
                @php
                    [$w,$h,$type,$attrs] = getimagesize('images/'.$product->image);
                @endphp
                <img
                    src=" {{ url('images/'.$product->image) }} "
                    alt=" {{ $product->detail }} "
                    {!! $attrs !!}
                    class=".img-fluid"
                    >
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="">
                <dl>
                    <div class=" rounded border border-secondary bg-light p-4">
                        <div class="d-flex">
                            <dd class="mr-2 sr-only">Título:</dd>
                            <dt class=""> <h1 class="text-center my-1 h4">{{$product->detail}} </h1></dt>
                        </div>
                        <div class="d-flex">
                            <dd class="mr-2 d-none">Categorías:</dd>
                            <dt class="pb-4">
                                @forelse ($product->genres  as $genre)
                                <span class="badge bg-secondary text-white">{{$genre->name}}</span>
                                @empty
                                Sin género
                                @endforelse
                            </dt>
                        </div>
                        <div class="d-flex">
                            <dd class="mr-2">Precio:</dd>
                            <dt>${{$product->price}}</dt>
                        </div>
                        <div class="d-flex">
                            <dd class="mr-2">País:</dd>
                            <dt>{{$product->country->name}}</dt>
                        </div>
                        <div class="d-flex">
                            <dd class="mr-2">Fecha de fabricación:</dd>
                            <dt>{{$product->date->format(__('dates.format'))}}</dt>
                        </div>
                        <dd class="mr-2">Detalle del producto:</dd>
                        <dt>{{$product->description}}</dt>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
