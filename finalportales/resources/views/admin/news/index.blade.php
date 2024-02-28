@extends('layouts.admin')

@section('title','ABM Noticias')

@section('main')
<div class="container-fluid container-padding" style="margin:0px;">

    <div class="col-12 p-5 bg-abmnoticias text-center text-white d-flex justify-content-center align-items-center" >
        <h2 class="w-100 text-center my-5">ABM DE NOTICIAS</h2>
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
            <a href="{{route('create.form.new')}}" class="btn btn-primary btn-outline my-3">Nuevo</a>
        </div>
    </div>
@endauth

<div class="d-flex justify-content-around align-items-center w-100">
    <h2 class="w-100 sr-only">Buscador</h2>
    <form action="{{ route('admin.news.index') }}" method="get" class="d-flex py-3">
        <label class="form-label sr-only" for="q" >Titulo</label>
        <input
            id="q"
            class="form-control"
            type="search"
            name="q"
            placeholder="busqueda por titulo"
            style="width: 850px;"
            value={{ $q }}
            >
        <button class="btn btn-primary mx-2" type="submit">Buscar</button>
    </form>
</div>
@if($news->isNotEmpty())
<table class="table table-striped table-bordered w-100">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            {{-- <th>Detalle</th> --}}
            {{-- <th>Contenido</th> --}}
            <th>Creador</th>
            <th>Generos</th>
            <th>Fecha de Creación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($news as $new)

            <tr>
                <td>{{$new->id_new}}</td>
                <td>{{$new->title}}</td>
                {{-- <td>{{$new->detail}}</td> --}}
                {{-- <td>{{$new->description}}</td> --}}
                <td>{{$new->user->name}}</td>
                <td class="">
                    @forelse($new->genres as $genre)
                        <span class="badge bg-secondary text-white">{{$genre->name}}</span>
                    @empty
                        <p>No se especificó</p>
                    @endforelse

                </td>
                <td>{{$new->date->format(__('dates.format'))}}</td>
                <td class="d-flex">
                    <a class="btn btn-info m-1" href="{{route('admin.news.show', ['id'=> $new->id_new])}}">Ver</button>

                    @auth
                        <a class="btn btn-warning m-1" href="{{route('edit.form.new', ['id'=>$new->id_new])}}">Editar</a>
                        <div>
                            <form class=" m-1" action="{{route('news.delete',['id'=>$new->id_new])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    @endauth
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$news->links()}}
@else
    <div class="text-center font-weight-bold p-5">NO HAY NOTICIAS PARA MOSTRAR</div>
@endif
</div>
</div>
@endsection
