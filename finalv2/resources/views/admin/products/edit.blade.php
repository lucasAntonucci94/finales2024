@extends('layouts.childadmin')

@section('title','Pantalla Editar Producto')

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
        <h2 class="w-100 text-center my-5">Edita el producto: {{$product->detail}}</h2>
        <!-- error se crea por default via laravel por lo que al poner le any(), en caso de haber un error o no esta siempre existira como variable, pero vacia en caso de no catchear nada -->
        @if($errors->any())
        <div class="alert alert-danger">Hay errores en los valores del formulario. Por favor, revise los campos y corrija el error.</div>
        @endif


            {{-- FORMULARIO --}}
        <div class="container w-100 text-center ">
            <form class="row mx-auto" action="{{route('products.edit',['id'=> $product->id_product])}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <label for="detail"  class="form-label my-3">Nombre</label>
                            <input type="text" name="detail" id="detail" class="form-label  w-100  @error('detail') is-invalid @enderror"
                            @error('detail') aria-describedby="error-detail" @enderror
                            value="{{old('detail', $product->detail)}}"
                            >
                            @error('detail')
                            <div id="error-detail" class="text-danger text-small"><p>{{ $message }}</p></div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="price"  class="form-label my-3">Precio</label>
                            <input type="number" name="price" id="price" class="form-label  w-100 @error('price') is-invalid @enderror"
                            @error('price') aria-describedby="error-price" @enderror
                            value="{{old('price', $product->price)}}"
                            >
                            @error('price')
                            <div id="error-price" class="text-danger text-small"><p>{{ $message }}</p></div>
                            @enderror
                        </div>
                        <div class="col-12 ">
                            <label for="id_country" class="form-label">Pais</label>
                            <select name="id_country" id="id_country" style="margin: auto;" class="form-control w-100">
                                <option value="">Elegí el país</option>
                                @foreach($countrys as $country)
                                <option
                                value="{{$country->id_country}}"
                                @selected($country->id_country == old('id_country',$product->id_country))
                                >{{$country->name}}</option>
                                @endforeach
                            </select>
                            @error('id_country')
                            <div id="error-id_country" class="text-danger text-small"><p>{{ $message }}</p></div>
                            @enderror
                        </div>
                        <div class="col-12 ">
                            <label for="id_provider" class="form-label">Proveedor</label>
                            <select name="id_provider" id="id_provider" style=" margin: auto;" class="form-control  w-100">
                                <option value="">Elegí el proveedor</option>
                                @foreach($providers as $provider)
                                <option
                                value="{{$provider->id_provider}}"
                                @selected($provider->id_provider == old('id_provider',$product->id_provider))
                                >{{$provider->name}}</option>
                                @endforeach
                            </select>
                            @error('id_provider')
                            <div id="error-id_provider" class="text-danger text-small"><p>{{ $message }}</p></div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="date"  class="form-label my-3">Fecha de producción</label>
                            <input  type="date" name="date" id="date" class="form-label  w-100 @error('date') is-invalid @enderror"
                            @error('error-date') aria-describedby="error-date" @enderror
                            value="{{old('date', $product->date->toDateString())}}"
                            >
                            @error('date')
                            <div id="error-date" class="text-danger text-small"><p>{{ $message }}</p></div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label  my-3">Descripción</label>
                            <textarea type="text" name="description" id="description"  style="min-height:250px;" class="form-label w-100 @error('description') is-invalid @enderror"
                            @error('description') aria-describedby="error-description" @enderror
                            >  {{old('description', $product->description)}}</textarea>
                            @error('description')
                            <div id="error-description" class="text-danger text-small"><p>{{ $message }}</p></div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row d-flex justify-content-center align-items-center ">
                        <div class="col-12 my-4">
                            <fieldset class=""  style="width:650px; margin: 0 auto;">
                                <legend>Generos</legend>
                                @foreach($genres as $genre)
                                <div class="form-check form-check-inline">
                                    <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="id_genre[]"
                                    id="id_genre-{{$genre->id_genre}}"
                                    value="{{$genre->id_genre}}"

                                    @checked(in_array($genre->id_genre, old('id_genre',$product->genres->pluck('id_genre')->all())))

                                    >
                                    <label for="id_genre-{{$genre->id_genre}}" class="form-check-input">
                                        {{$genre->name}}
                                    </label>
                                </div>
                                @endforeach
                            </fieldset>
                        </div>
                        <div class="col-6">
                            @if ($product->image != '' && file_exists('images/'.$product->image))
                            <p class=" my-3">Imagen actual:</p>
                            @php
                                [$w,$h,$type,$attrs] = getimagesize('images/'.$product->image);
                            @endphp
                            <img
                                src=" {{ url('images/'.$product->image) }} "
                                alt=" {{ $product->detail }} "
                                style="width: 100%"
                                class=".img-fluid"
                            >
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="image"  class="form-label w-100 my-3">Seleccione una nueva imagen:</label>
                            <input type="file" name="image" id="image" class="form-label small">
                        </div>

                    </div>
                </div>
                <div class="col-12 d-flex my-3">
                    <a href="{{url('admin/products')}}" class="btn btn-secondary mx-3 w-100">Cancelar</a>
                    <button class="btn btn-success  mx-3 w-100" type="submit">Aceptar</button>
                </div>
            </form>
        </div>


    </div>
@endsection
