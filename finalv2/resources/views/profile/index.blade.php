@extends('layouts.main')

@section('title','Perfil Usuario: '.$user->name)

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
    <div class="container p-3 m-4">
        <h1 class="text-secondary text-center display-4 mb-4">Perfil</h2>
        
        <div class="row d-flex align-items-center">
            
            <div class="col-md-3 text-center">
            <img src="{{ url('images/'.$user->image) }}" alt="User image" class="img-rounded img-thumbnail">
            </div>
            <div class="col-md-9">
            <div class="rounded border border-secondary bg-light p-4">

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
                <div class="d-flex">
                    <a href="{{route('edit.form.profile', ['id'=>$user->id])}}" class="btn btn-secondary mx-1 my-1 w-50">Editar</a>
                    <a class="btn btn-info text-white mx-1 my-1 w-50" href="{{route('profile.orders.show', ['id'=> $user->id])}}">Ver Pedidos</a>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
