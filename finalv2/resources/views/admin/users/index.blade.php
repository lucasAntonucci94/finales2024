@extends('layouts.admin')

@section('title','ABM Noticias')

@section('main')
<div class="container-fluid container-padding" style="margin:0px;">

    <div class="col-12 p-5 bg-users text-center text-white d-flex justify-content-center align-items-center" >
        <h2 class="w-100 text-center my-5">ABM DE USUARIOS</h2>
    </div>
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
    <div class="container">

    @auth
    <div class="row  w-100">
        <div class="col-11">
            <a class="btn btn-dark my-3 text-white" href="<?= url('admin/dashboard');?>">Volver al panel</a>
        </div>
        <div class="col-1">
            <a href="{{route('create.form.user')}}" class="btn btn-primary btn-outline my-3">Nuevo</a>
        </div>
    </div>
@endauth

<div class="d-flex justify-content-around align-items-center w-100">
    <h2 class="w-100 sr-only">Buscador</h2>
    <form action="{{ route('admin.users.index') }}" method="get" class="d-flex py-3">
        <label class="form-label sr-only" for="q" >Email</label>
        <input
            id="q"
            class="form-control"
            type="search"
            name="q"
            placeholder="busqueda por email"
            style="width: 850px;"
            value={{ $q }}
        >
        <button class="btn btn-primary mx-2" type="submit">Buscar</button>
    </form>
</div>
@if($users->isNotEmpty())
<table class="table table-striped table-bordered w-100">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Fecha de Creación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($users as $user)

            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{($user->id_role == 1) ? 'Administrador' : 'Usuario'}}</td>
                <td>{{$user->created_at->format(__('dates.format'))}}</td>
                <td class="d-flex">
                    <a class="btn btn-info m-1" href="{{route('admin.users.show', ['id'=> $user->id])}}">Ver</button>

                        @auth
                        <a class="btn btn-warning m-1" href="{{route('edit.form.user', ['id'=>$user->id])}}">Editar</a>
                        <div>
                            <form class="m-1" action="{{route('users.delete',['id'=>$user->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                        @endauth
                    <a class="btn btn-primary m-1" href="{{route('admin.users.show.order', ['id'=> $user->id,'backurl'=>'admin.users.index'])}}">Pedidos</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- {{$users->links()}} --}}
@else
    <div class="text-center font-weight-bold p-5">NO HAY USUARIOS PARA MOSTRAR</div>
@endif

</div>
</div>
@endsection
