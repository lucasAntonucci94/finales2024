@extends('layouts.main')

@section('title','Perfil Usuario: '.$user->name)

@section('main')
    <div class="row py-4 bg-light deleteRowMargin">
        <div class="col-12 text-center">
            <h1>Perfil de usuario: {{ $user->name }}</h1>
        </div>
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
    <div class="row d-flex justify-content-center align-items-center m-5 p-5">
        @if ($user->image != null && $user->image != '' && file_exists('images/'.$user->image))
        <div class="col-md-3 text-center">
            <img src="{{ url('images/'.$user->image) }}" alt="User image" class="img-rounded img-thumbnail">
        </div>
        <div class="col-md-6">
        @else
            <div class="col-md-8">
                @endif
                <div class="rounded border border-secondary bg-light p-4">
                    <div class="d-flex">
                        <span class="mr-2">Nombre:</span>
                        <p class="textBreak font-weight-bold">{{ $user->name }}</p>
                    </div>
                    <div class="d-flex">
                        <span class="mr-2">Email:</span>
                        <p class="textBreak font-weight-bold">{{ $user->email }}</p>
                    </div>
                    <div class="d-flex">
                        <span class="mr-2">Rol:</span>
                        <p class="textBreak font-weight-bold">{{($user->id_role == 1) ? 'Administrador' : 'Usuario'}}</p>
                    </div>
                    <div class="d-flex">
                        <span class="mr-2">Fecha:</span>
                        <p class="textBreak font-weight-bold">{{$user->created_at->format(__('dates.format'))}}</p>
                    </div>
                    <div class="d-flex">
                        <a href="{{route('edit.form.profile', ['id'=>$user->id])}}" class="btn btn-secondary mx-1 my-1 w-50">Editar</a>
                        <a class="btn btn-info text-white mx-1 my-1 w-50" href="{{route('profile.orders.show', ['id'=> $user->id])}}">Ver Pedidos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
