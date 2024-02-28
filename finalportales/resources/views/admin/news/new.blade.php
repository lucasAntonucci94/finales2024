@extends('layouts.admin')

@section('title','Pantalla Nueva Noticia')

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
    <h2 class="w-100 text-center my-5">Crea una noticia</h2>
    @if($errors->any())
        <div class="alert alert-danger">Hay errores en los valores del formulario. Por favor, revise los campos y corrija el error.</div>
    @endif
    <div class="container w-100 text-center ">
        <form class="row mx-auto" action="{{route('news.create')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-6">
                <div class="row d-flex">
                    <div class="col-12">
                        <label for="title"  class="form-label w-100 my-3">Nombre</label>
                        <input type="text" name="title" id="title" class="form-label w-100 @error('title') is-invalid @enderror"
                        @error('title') aria-describedby="error-title" @enderror
                        value="{{old('title')}}"
                        >
                        @error('title')
                            <div id="error-title" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="detail"  class="form-label w-100 my-3">Detalle</label>
                        <input type="text" name="detail" id="detail" class="form-label w-100 @error('detail') is-invalid @enderror"
                        @error('detail') aria-describedby="error-detail" @enderror
                        value="{{old('detail')}}"
                        >
                        @error('detail')
                            <div id="error-detail" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="date"  class="form-label w-100 my-3">Fecha Creación</label>
                        <input  type="date" name="date" id="date" class="form-label w-100 @error('date') is-invalid @enderror"
                        @error('error-date') aria-describedby="error-date" @enderror
                        value="{{old('date')}}"
                        >
                        @error('date')
                            <div id="error-date" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label w-100  my-3">Descripción</label>
                        <textarea type="text" name="description" id="description"  style="height:250px;" class="form-label w-100 @error('description') is-invalid @enderror"
                        @error('description') aria-describedby="error-description" @enderror
                        value="">  {{old('description')}}</textarea>
                        @error('description')
                            <div id="error-description" class="text-danger text-small"><p>{{ $message }}</p></div>
                        @enderror
                    </div>

                </div>

            </div>
            <div class="col-6">
                <div class="col-12">

                    @foreach(old('id_genre') ?? [] as $d)
                    <div class="d-none"> {{$d}} </div>
                    @endforeach

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
                                    @checked(in_array($genre->id_genre, old('id_genre') ?? [] ))
                                    >
                                    <label for="id_genre-{{$genre->id_genre}}" class="form-check-input">
                                        {{$genre->name}}
                                    </label>
                                </div>
                            @endforeach
                    </fieldset>
                </div>
                <div class="col-12">
                    <label for="image"  class="form-label w-100 my-3">Portada</label>
                    <input type="file" name="image" id="image" class="form-label">
                </div>
                <div id="preview" class="col-12 d-none">
                    <p>Previsualización de la imagen</p>
                    <img id="preview-image" src="" alt="">
                </div>

                <div class="col-12 d-none">
                    <label for="id_user"  class="form-label w-100 my-3">id_user</label>
                    <input  type="text" name="id_user" id="id_user"  style="width:650px" class="form-label"
                    value="{{auth()->user()->id}}"
                    >
                </div>
            </div>

            <div class="col-12 my-3 d-flex">
                <a href="{{url('admin/news')}}" class="btn btn-secondary w-100 mx-3">Cancelar</a>
                <button class="btn btn-success w-100 mx-3" type="submit">Aceptar</button>
            </div>
            <div class="col-12 d-flex my-3">

            </div>
        </form>


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
