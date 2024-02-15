@extends('layouts.childadmin')

@section('title','Pantalla Ver Usuario: '.$user->name)

@section('main')
<div class="container container-padding ">
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
<h2 class="w-100 text-center my-5 textBreak">Vista del Usuario: {{$user->name}} </h2>
<div class="text-center">

    @if ($user->image != '' && file_exists('images/'.$user->image))
        @php
            [$w,$h,$type,$attrs] = getimagesize('images/'.$user->image);
        @endphp
        <img
            src=" {{ url('images/'.$user->image) }} "
            alt=" {{ $user->detail }} "
            {!! $attrs !!}
            class=".img-fluid"
            >
    @endif

</div>

<dl class="py-3" >
    <div class=" rounded border border-secondary bg-light p-4">
        <div class="d-flex">
            <dd class="mr-2">Nombre:</dd>
            <dt class="textBreak">{{ $user->name }}</dt>
        </div>
        <div class="d-flex">
            <dd class="mr-2">Email:</dd>
            <dt>{{ $user->email }}</dt>
        </div>
        <div class="d-flex">
            <dd class="mr-2">Rol:</dd>
            <dt>{{($user->id_role == 1) ? 'Administrador' : 'Usuario'}}</dt>
        </div>
        <div class="d-flex">
            <dd class="mr-2">Fecha:</dd>
            <dt>{{$user->created_at->format(__('dates.format'))}}</dt>
        </div>
    </div>
</dl>
<div class="d-flex">

    {{-- <a href="{{url('admin/orders/{id_user}')}}" class="btn btn-secondary my-1 w-100">VER PEDIDOS</a> --}}
    <a href="{{url('admin/users')}}" class="btn btn-secondary mx-1 my-1 w-100">VOLVER</a>
    <a class="btn btn-info text-white mx-1 my-1 w-100" href="{{route('admin.users.show.order', ['id'=> $user->id,'backurl'=> 'admin.users.show'])}}">VER PEDIDOS</a>
</div>

</div>
@endsection
