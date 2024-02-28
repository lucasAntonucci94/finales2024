@extends('layouts.admin')

@section('title','Pantalla Editar Noticia')

@section('main')
<div class="container-fluid">
    <div class="row py-4 bg-light">
        <div class="col-12 text-center">
            <h1 class="">Edita el estado del pedido {{$order->id}}</h1>
        </div>
        <!-- @if(Session::has('message.success'))
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
        @if($errors->any())
            <div class="alert alert-danger">Hay errores en los valores del formulario. Por favor, revise los campos y corrija el error.</div>
        @endif -->
    </div>
    <div class="container w-100">
        <form class="row justify-content-center mx-auto" action="{{route('orders.edit',['id'=> $order->id])}}" method="post"  enctype="multipart/form-data">
            <!-- <div class="col-12">
                <a class="btn btn-dark my-3 text-white" href="<?= url('admin/orders');?>">Volver</a>
            </div> -->
          
            @csrf
            <div class="col-7 border p-5 mt-3">
                <div class="row d-flex">
                <div class="col-12 my-1">
                    <p class="text-center small text-danger">A las ordenes de compra se le puede modificar unicamente la descripcion del estado.</p>
                </div>
                    <div class="col-12 d-none">
                        <label for="id"  class="form-label">ID</label>
                        <input  type="text" name="id" id="id" class="form-label w-100"
                        value="{{old('id', $order->id)}}"
                        disabled
                    >
                    </div>
                    <div class="col-12">
                        <label for="id_user1"  class="form-label mb-2">Usuario</label>
                        <input type="text" name="id_user1" id="id_user1" class="form-label w-100"
                        value="{{old('id_user', $order->user->id)}}"
                        disabled
                        >
                    </div>
                    <div class="col-12  sr-only">
                        <label for="id_user"  class="form-label my-2">Usuario</label>
                        <input type="text" name="id_user" id="id_user" class="form-label w-100" value="{{old('id_user', $order->user->id)}}">
                    </div>
                    <div class="col-12">
                        <label for="created_at"  class="form-label my-2">Fecha de creación</label>
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
                        <label for="status"  class="form-label my-2">Estado</label>
                        <input type="text" name="status" id="status"  class="form-label w-100 @error('status') is-invalid @enderror"
                        @error('status') aria-describedby="error-status" @enderror
                        value="{{old('status', $order->status)}}"
                        >
                        @error('status')
                            <div id="error-status" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="enabled"  class="form-label my-2">Activo</label>
                        <input type="text" name="enabled" id="enabled"  class="form-label w-100 @error('enabled') is-invalid @enderror"
                        @error('enabled') aria-describedby="error-enabled" @enderror
                        value="{{old('enabled', $order->enabled)}}"
                        disabled
                        >
                        @error('enabled')
                            <div id="error-enabled" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-7 my-4 d-flex">
                <a href="{{url('admin/orders')}}" class="btn btn-secondary w-100 mx-3">Cancelar</a>
                <button class="btn btn-success w-100  mx-3" type="submit">Aceptar</button>
            </div>
        </form>
    </div>

</div>
@endsection
