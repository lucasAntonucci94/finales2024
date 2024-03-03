@extends('layouts.main')

@section('title','Pantalla Ver Noticia: '.$new->detail)

@section('main')
<div class="container container-padding">

    <h1 class="w-100 text-center mt-3 textBreak">{{$new->title}} </h1>
    <div class="text-center p-3">
        @if ($new->image != '' && file_exists('images/'.$new->image))
            @php
                [$w,$h,$type,$attrs] = getimagesize('images/'.$new->image);
            @endphp
            <img
                src=" {{ url('images/'.$new->image) }} "
                alt=" {{ $new->detail }} "
                class=".img-fluid w-100"
                >
        @endif
    </div>
    <dl class="p-3" >
        <div class="d-flex">
            <dd class="mr-2 d-none">Categorías:</dd>
            <dt class="pb-4">
                @forelse ($new->genres  as $genre)
                <span class="badge bg-secondary text-white">{{$genre->name}}</span>
                @empty
                Sin genero
                @endforelse
            </dt>
        </div>
        <div class=" rounded border border-secondary bg-light p-4">
            <div class="d-flex small">
                <dd class="mr-2">Fecha de publicación:</dd>
                <dt>{{$new->date->format(__('dates.format'))}}</dt>
            </div>
            <div class="d-flex">
                <dd class="mr-2 sr-only">Detalle:</dd>
                <dt class="h4 mb-3">{{ $new->detail }}</dt>
            </div>
            <div class="d-flex">
                <dd class="mr-2 sr-only">Contenido</dd>
                <dt  class="textBreak">{{$new->description}}</dt>
            </div>
        </div>
        <a href="{{url('news')}}" class="btn btn-secondary my-2 w-100">VOLVER</a>
    </dl>

</div>
@endsection
