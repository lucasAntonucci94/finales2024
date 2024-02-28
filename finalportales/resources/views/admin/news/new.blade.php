@extends('layouts.admin')

@section('title','Pantalla Editar Noticia')

@section('main')
<div class="container-fluid">
    <div class="row py-4 bg-light">
        <div class="col-12 text-center">
            <h1>Crear noticia</h1>
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


<div class="container w-100  pb-5">
    <form class="row mx-auto border mt-3 mb-5 p-5" action="{{route('news.create')}}" method="post"  enctype="multipart/form-data">
        @csrf

        <div class="col-6">
            <div class="row d-flex">
                <div class="col-12 d-none">
                    <label for="id_user"  class="form-label my-2">id_user</label>
                    <input  type="text" name="id_user" id="id_user" class="form-label w-100"
                    value="{{old('id_user', auth()->user()->id)}}"
                >
                </div>
                <div class="col-12">
                    <label for="title"  class="form-label my-3">Nombre</label>
                    <input type="text" name="title" id="title" class="form-label w-100 @error('title') is-invalid @enderror"
                    @error('title') aria-describedby="error-title" @enderror
                    value="{{old('title')}}"
                    >
                    @error('title')
                        <div id="error-title" class="text-danger text-small"><p>{{ $message }}</p></div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="detail"  class="form-label my-3">Detalle</label>
                    <input type="text" name="detail" id="detail"  class="form-label w-100 @error('detail') is-invalid @enderror"
                    @error('detail') aria-describedby="error-detail" @enderror
                    value="{{old('detail')}}"
                    >
                    @error('detail')
                        <div id="error-detail" class="text-danger text-small"><p>{{ $message }}</p></div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="date"  class="form-label my-3">Fecha de producción</label>
                    <input  type="date" name="date" id="date"  class="form-label w-100 @error('date') is-invalid @enderror"
                    @error('error-date') aria-describedby="error-date" @enderror
                    value="{{old('date')}}"
                    >
                    @error('date')
                        <div id="error-date" class="text-danger text-small"><p>{{ $message }}</p></div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="description" class="form-label my-3">Contenido</label>
                    <textarea type="text" name="description" id="description"  style="min-height:250px;" class="form-label w-100 @error('description') is-invalid @enderror"
                    @error('description') aria-describedby="error-description" @enderror
                    >  {{old('description')}}</textarea>
                    @error('description')
                        <div id="error-description" class="text-danger text-small"><p>{{ $message }}</p></div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row d-flex">
            <div class="col-12 my-2 d-flex flex-wrap justify-content-between">
                            <fieldset class="border border-secondary rounded p-3 shadow-sm">
                                <legend class="font-weight-bold text-center border-bottom pb-2">Generos</legend>
                                <div class="row">
                                @foreach($genres as $genre)
                                    <div class="col-md-6 col-sm-6 d-flex justify-content-between">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="id_genre[]"
                                                id="id_genre-{{$genre->id_genre}}" value="{{$genre->id_genre}}"
                                                @checked(in_array($genre->id_genre, old('id_genre') ?? [] ))
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
                        <label for="image"  class="form-label w-100 my-2">Portada:</label>
                        <input type="file" name="image" id="image" class="form-label small">
                    </div>
                    <div id="preview" class="col-12 d-none py-2">
                        <p>Previsualización de la imagen</p>
                        <img id="preview-image" class="w-50" src="" alt="">
                    </div>
            </div>
        </div>
        <div class="col-12 d-flex mt-5">
            <a href="{{url('admin/news')}}" class="btn btn-secondary w-100 mx-3">Cancelar</a>
            <button class="btn btn-success w-100  mx-3" type="submit">Aceptar</button>
        </div>
    </form>
</div>

</div>
<script>
    const fileInput = document.getElementById('image');
    const previewDiv = document.getElementById('preview');
    const previewImg = document.getElementById('preview-image');
    fileInput.addEventListener('change', function(){
        const freader = new FileReader();
        freader.addEventListener('load', function(){
            previewImg.src = freader.result;
            previewDiv.classList.remove('d-none');
        });
        freader.readAsDataURL(this.files[0]);
    });
</script>
@endsection
