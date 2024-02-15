@extends('layouts.childadmin')

@section('title','Pantalla Editar Noticia')

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
<h2 class="w-100 text-center my-5">Aquí podrás actualizar el estado del pedido ID: {{$order->id}}</h2>
@if($errors->any())
    <div class="alert alert-danger">Hay errores en los valores del formulario. Por favor, revise los campos y corrija el error.</div>
@endif

<div class="container w-100 text-center ">
    <form class="row justify-content-center mx-auto" action="{{route('orders.edit',['id'=> $order->id])}}" method="post"  enctype="multipart/form-data">
        @csrf
        <div class="col-8">
            <div class="row d-flex">
                <div class="col-12 d-none">
                    <label for="id"  class="form-label my-3">ID</label>
                    <input  type="text" name="id" id="id" class="form-label w-100"
                    value="{{old('id', $order->id)}}"
                    disabled
                >
                </div>
                <div class="col-12">
                    <label for="id_user1"  class="form-label my-3">Usuario</label>
                    <input type="text" name="id_user1" id="id_user1" class="form-label w-100"
                    value="{{old('id_user', $order->user->id)}}"
                    disabled
                    >
                </div>
                <div class="col-12">
                    <label for="id_product1"  class="form-label my-3">Producto</label>
                    <input type="text" name="id_product1" id="id_product1"  class="form-label w-100"
                    value="{{old('id_product', $order->product->id_product)}}"
                    disabled
                    >
                </div>
                <div class="col-12  sr-only">
                    <label for="id_user"  class="form-label my-3">Usuario</label>
                    <input type="text" name="id_user" id="id_user" class="form-label w-100" value="{{old('id_user', $order->user->id)}}">
                </div>

                <div class="col-12 sr-only">
                    <label for="id_product"  class="form-label my-3">Producto</label>
                    <input type="text" name="id_product" id="id_product"  class="form-label w-100" value="{{old('id_product', $order->product->id_product)}}">
                </div>

                <div class="col-12">
                    <label for="created_at"  class="form-label my-3">Fecha de creación</label>
                    <input  type="date" name="created_at" id="created_at"  class="form-label w-100 @error('created_at') is-invalid @enderror"
                    @error('error-created_at') aria-describedby="error-created_at" @enderror
                    value="{{old('created_at', $order->created_at->toDateString())}}"
                    disabled
                    >
                    @error('created_at')
                        <div id="error-created_at" class="text-danger text-small"><p>{{ $message }}</p></div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="status"  class="form-label my-3">Estado</label>
                    <input type="text" name="status" id="status"  class="form-label w-100 @error('status') is-invalid @enderror"
                    @error('status') aria-describedby="error-status" @enderror
                    value="{{old('status', $order->status)}}"
                    >
                    @error('status')
                        <div id="error-status" class="text-danger text-small"><p>{{ $message }}</p></div>
                    @enderror
                </div>

            </div>
        </div>
        <div class="col-12 my-3 d-flex">
            <a href="{{url('admin/orders')}}" class="btn btn-secondary w-100 mx-3">Cancelar</a>
            <button class="btn btn-success w-100  mx-3" type="submit">Aceptar</button>
        </div>
    </form>
</div>

</div>
@endsection
