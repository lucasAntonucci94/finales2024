@extends('layouts.admin')

@section('title','ABM Productos')

@section('main')
<div class="container-fluid container-padding" style="margin:0px;">


    <div class="col-12 p-5 bg-abmproducts text-center text-white  d-flex justify-content-center align-items-center" >
        <h2 class="w-100 text-center my-5">ABM DE PRODUCTOS</h2>
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
    @auth
    <div class="container">

    <div class="row">
        <div class="col-11">
            <a class="btn btn-dark my-3 text-white" href="<?= url('admin/dashboard');?>">Volver al panel</a>

        </div>
        <div class="col-1">
            <a href="{{route('create.form.product')}}" class="btn btn-primary btn-outline my-3">Nuevo</a>

        </div>
    </div>
    @endauth

    <div class="d-flex justify-content-around align-items-center w-100">
        <h2 class="w-100 sr-only">Buscador</h2>
        <form action="{{ route('admin.products.index') }}" method="get" class="d-flex py-3">
            <label class="form-label sr-only" for="q" >Titulo</label>
            <input
                id="q"
                class="form-control"
                type="search"
                name="q"
                placeholder="busqueda por nombre"
                style="width: 850px;"
                value={{ $q }}
            >
            <button class="btn btn-primary mx-2" type="submit">Buscar</button>
        </form>
    </div>
    @if($products->isNotEmpty())
    <table class="table table-striped table-bordered w-100">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                {{-- <th>Descripcion</th> --}}
                <th>Precio</th>
                {{-- <th>Pais</th> --}}
                <th>Generos</th>
                <th>Fecha de fabricación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        @foreach($products as $product)

            <tr>
                <td>{{$product->id_product}}</td>
                <td>{{$product->detail}}</td>
                {{-- <td>{{$product->description}}</td> --}}
                <td>{{$product->price}}</td>
                {{-- <td>{{$product->country->name}}</td> --}}
                <td >
                   @forelse($product->genres as $genre)
                        <span class="badge bg-secondary text-white">{{$genre->name}}</span>
                    @empty
                        <p>No tiene genero</p>
                    @endforelse
                </td>
                <td>{{$product->date->format(__('dates.format'))}}</td>
                <td class="d-flex">
                    <a class="btn btn-info m-1" href="{{route('admin.products.show', ['id'=> $product->id_product])}}">Ver</button>

                    @auth
                        <a class="btn btn-warning m-1" href="{{route('edit.form.product', ['id'=>$product->id_product])}}">Editar</a>
                        <div>
                            <form class=" m-1" action="{{route('products.delete',['id'=>$product->id_product])}}" method="post">
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
{{$products->links()}}
@else
    <div class="text-center font-weight-bold p-5">NO HAY PRODUCTOS PARA MOSTRAR</div>
@endif

</div>
</div>
@endsection
