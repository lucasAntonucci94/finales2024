@extends('layouts.admin')

@section('title','Pantalla Ver newo: '.$new->detail)

@section('main')
<div class="container container-padding">
    <h1 class="w-100 text-center my-5 textBreak h4">{{$new->detail}} </h1>

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
<div class="text-center">

    @if ($new->image != '' && file_exists('images/'.$new->image))
        @php
            [$w,$h,$type,$attrs] = getimagesize('images/'.$new->image);
        @endphp
        <img
            src=" {{ url('images/'.$new->image) }} "
            alt=" {{ $new->detail }} "
            {!! $attrs !!}
            class=".img-fluid w-100"
            >
    @endif

</div>

<dl class="py-3" >
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

        <div class="d-flex">
            <dd class="mr-2">Título:</dd>
            <dt class="textBreak">{{ $new->title }}</dt>
        </div>
        <div class="d-flex">
            <dd class="mr-2">Detalle:</dd>
            <dt>{{ $new->detail }}</dt>
        </div>
        <div class="d-flex">
            <dd class="mr-2">User:</dd>
            <dt>{{$new->user->name}}</dt>
        </div>
        <div class="d-flex">
            <dd class="mr-2">Fecha:</dd>
            <dt>{{$new->date->format(__('dates.format'))}}</dt>
        </div>
        <dd class="mr-2">Contenido</dd>
        <dt class="textBreak">{{$new->description}}</dt>
    </div>
</dl>

<a href="{{url('admin/news')}}" class="btn btn-secondary my-1 w-100">VOLVER</a>

</div>
@endsection
