@extends('layouts.main')

@section('title','Pantalla Noticias')

@section('main')

<div class="container-fluid deleteRowMargin container-padding">
    <div class="bg-secondary d-flex justify-content-around align-items-center">
        <h1 class="w-100 text-center text-white py-5">Novedades</h1>
    </div>
    @if($news->isNotEmpty())
    <div class="row d-flex justify-content-around align-items-center deleteRowMargin">
        @foreach($news as $new)
        <div class="col-7 rounded border-secondary text-center border m-4 p-2">
            @if ($new->image != '' && file_exists('images/'.$new->image))
                @php
                    [$w,$h,$type,$attrs] = getimagesize('images/'.$new->image);
                @endphp
                <img
                    src=" {{ url('images/'.$new->image) }} "
                    alt=" {{ $new->title }} "
                    class=".img-fluid"
                    style="max-width: 100%;"
                    >
            @endif
            <div class="container p-3">
                <p class="pt-4 text-left textBreak text-uppercase h3"> <b> {{$new->title}}</b></p>
                <p class="pt-4 text-left textBreak">{{$new->detail}}</p>
                <a class="btn btn-warning mt-2 w-100 font-weight-bold" href="{{route('news.show', ['id'=> $new->id_new])}}">VER</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
    <div class="text-center font-weight-bold p-5">NO HAY NOTICIAS PARA MOSTRAR</div>
@endif

@endsection
