@extends('layouts.admin')

@section('title','Pantalla Editar Producto')

@section('main')
<div class="container-fluid">
    <div class="row py-4 bg-light">
        <div class="col-12 text-center">
            <h1>Edita el producto: {{ $product->detail }}</h1>
        </div>
        <div class="col-12">
            @if (Session::has('message.success'))
            <div class="alert alert-success alert-dismissible fade show">
                <strong class="text-center">{!! Session::get('message.success') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (Session::has('message.error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <strong class="text-center">{!! Session::get('message.error') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>
    <!-- error se crea por default via laravel por lo que al poner le any(), en caso de haber un error o no esta siempre existira como variable, pero vacia en caso de no catchear nada -->
    @if($errors->any())
    <div class="alert alert-danger text-center">Hay errores en los valores del formulario. Por favor, revise los campos y corrija el error.</div>
    @endif
    {{-- FORMULARIO --}}
    <div class="container w-100  pb-5">
        <form class="row mx-auto border mt-3 mb-5 p-5" action="{{route('products.edit',['id'=> $product->id_product])}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <label for="detail"  class="form-label my-2">Nombre</label>
                        <input type="text" name="detail" id="detail" placeholder="Ingrese un nombre" class="form-control  w-100  @error('detail') is-invalid @enderror"
                        @error('detail') aria-describedby="error-detail" @enderror
                        value="{{old('detail', $product->detail)}}"
                        >
                        @error('detail')
                        <div id="error-detail" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="price"  class="form-label my-2">Precio</label>
                        <input type="number" name="price" id="price" placeholder="Ingrese un precio" class="form-control  w-100 @error('price') is-invalid @enderror"
                        @error('price') aria-describedby="error-price" @enderror
                        value="{{old('price', $product->price)}}"
                        >
                        @error('price')
                        <div id="error-price" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>
                    <div class="col-12 ">
                        <label for="id_country" class="form-label my-2">Pais</label>
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
                        <label for="id_provider" class="form-label my-2">Proveedor</label>
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
                        <label for="date"  class="form-label my-2">Fecha de producción</label>
                        <input  type="date" name="date" id="date" class="form-control w-100 @error('date') is-invalid @enderror"
                        @error('error-date') aria-describedby="error-date" @enderror
                        value="{{old('date', $product->date->toDateString())}}"
                        >
                        @error('date')
                        <div id="error-date" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label  my-2">Descripción</label>
                        <textarea type="text" name="description" id="description"  style="min-height:250px;" class="form-control w-100 @error('description') is-invalid @enderror"
                        @error('description') aria-describedby="error-description" @enderror
                        >  {{old('description', $product->description)}}</textarea>
                        @error('description')
                        <div id="error-description" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row d-flex justify-content-center align-items-center p-3">
                    <div class="col-12 my-2 d-flex flex-wrap justify-content-between">
                        <fieldset class="border border-secondary rounded p-3 shadow-sm">
                            <legend class="font-weight-bold text-center border-bottom pb-2">Generos</legend>
                            <div class="row">
                            @foreach($genres as $genre)
                                <div class="col-md-6 col-sm-6 d-flex justify-content-between">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="id_genre[]"
                                        id="id_genre-{{$genre->id_genre}}" value="{{$genre->id_genre}}"
                                        @checked(in_array($genre->id_genre, old('id_genre', $product->genres->pluck('id_genre')->all())))>
                                    <label class="form-check-label" for="id_genre-{{$genre->id_genre}}">
                                    {{ $genre->name }}
                                    </label>
                                </div>
                                </div>
                            @endforeach
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-6">
                        @if ($product->image != '' && file_exists('images/'.$product->image))
                        <p class=" my-2">Imagen actual:</p>
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
                        <label for="image"  class="form-label w-100 my-2">Seleccione una nueva imagen:</label>
                        <input type="file" name="image" id="image" class="form-control small">
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex mt-5">
                <a href="{{url('admin/products')}}" class="btn btn-secondary mx-3 w-100">Cancelar</a>
                <button class="btn btn-success  mx-3 w-100" type="submit">Aceptar</button>
            </div>
        </form>
    </div>
</div>
<script>
        const descriptionInput = document.getElementById("description");
        descriptionInput.addEventListener("input", () => {
            const value = descriptionInput.value;

            if (value.length < 10) {
                descriptionInput.classList.add("is-invalid");
            } else {
                descriptionInput.classList.remove("is-invalid");
                descriptionInput.classList.add("is-valid");
            }
        });

        const detailInput = document.getElementById("detail");
        detailInput.addEventListener("input", () => {
            const value = detailInput.value;

            if (value.length < 6) {
                detailInput.classList.add("is-invalid");
            } else {
                detailInput.classList.remove("is-invalid");
                detailInput.classList.add("is-valid");
            }
        });
        
        const priceInput = document.getElementById("price");
        priceInput.addEventListener("input", () => {
            const value = priceInput.value;

            if (parseInt(value) < 0) {
                priceInput.classList.add("is-invalid");
            } else {
                priceInput.classList.remove("is-invalid");
                priceInput.classList.add("is-valid");
            }
        });

        const dateInput = document.getElementById("date");
        dateInput.addEventListener("input", () => {
            const value = dateInput.value;
            const dateRegex = /^\d{4}-\d{2}-\d{2}$/;

            if (!dateRegex.test(value)) {
                dateInput.classList.add("is-invalid");
            } else {
                dateInput.classList.remove("is-invalid");
                dateInput.classList.add("is-valid");
            }
        });

        const countrySelect = document.getElementById("id_country");
        const providerSelect = document.getElementById("id_provider");

        // Add event listeners for both select boxes
        countrySelect.addEventListener("change", handleSelectChange);
        providerSelect.addEventListener("change", handleSelectChange);

        function handleSelectChange(event) {
        const selectElement = event.target; // Get the select element that triggered the event

        // Check if a valid option is selected (value is not empty)
        if (selectElement.value !== "") {
            selectElement.classList.add("is-valid"); // Add "is-valid" class to the selected option
            selectElement.classList.remove("is-invalid"); // Remove any previous "is-invalid" class
        } else {
            selectElement.classList.remove("is-valid"); // Remove "is-valid" class if no option is selected
            selectElement.classList.add("is-invalid"); // Add "is-invalid" class to indicate error
        }
        }

</script>
@endsection
