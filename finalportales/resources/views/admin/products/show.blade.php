@extends('layouts.admin')

@section('title','Pantalla Ver Producto: '.$product->detail)

@section('main')
<div class="container container-padding">
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
<h2 class="w-100 text-center my-5">Vista del producto: {{$product->detail}} </h2>
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

<dl class="py-3" >
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
            <dd class="mr-2">Título:</dd>
            <dt>{{ $product->detail }}</dt>
        </div>
        <div class="d-flex">
            <dd class="mr-2">Precio:</dd>
            <dt>{{$product->price}}</dt>
        </div>
        <div class="d-flex">
            <dd class="mr-2">País:</dd>
            <dt>{{$product->country->name}}</dt>
        </div>
        <div class="d-flex">
            <dd class="mr-2">Fecha:</dd>
            <dt>{{$product->date->format(__('dates.format'))}}</dt>
        </div>
        <dd class="mr-2">Detalle</dd>
        <dt>{{$product->description}}</dt>
    </div>
</dl>

<a href="{{url('admin/products')}}" class="btn btn-secondary my-1 w-100">VOLVER</a>

</div>
@endsection
