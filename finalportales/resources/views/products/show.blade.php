@extends('layouts.main')

@section('title','Pantalla Ver Producto: '.$product->detail)

@section('main')
<div class="container container-padding">

<h2 class="w-100 text-center my-5">{{$product->detail}} </h2>
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
<div class="p-5">

<dl>
    <div class="d-flex">
        <dd class="mr-2 d-none">Categorías:</dd>
        <dt class="pb-4">
            @forelse ($product->genres  as $genre)
            <span class="badge bg-secondary text-white">{{$genre->name}}</span>
            @empty
            Sin genero
            @endforelse
            {{-- {{$product->country->name}} --}}
        </dt>
    </div>
    <div class=" rounded border border-secondary bg-light p-4">

        <div class="d-flex">
            <dd class="mr-2 sr-only">Título:</dd>
            <dt class="h4">{{ $product->detail }}</dt>
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
<a href="{{url('products')}}" class="btn btn-secondary my-1 w-100 px-5">VOLVER</a>

</div>

</div>
@endsection
