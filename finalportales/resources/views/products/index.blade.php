@extends('layouts.main')

@section('title', 'Pantalla Productos')

@section('main')
    <div class="container-fluid bg-light container-padding">
        <div class="bg-secondary d-flex justify-content-around align-items-center">
            <h2 class="w-100 text-center text-white py-5">Catalogo de productos</h2>
        </div>
        @if (Session::has('message.success'))
            <div class="alert text-center alert-success alert-dismissible fade show">

                <strong>{!! Session::get('message.success') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (Session::has('message.error'))
            <div class="alert text-center alert-danger alert-dismissible fade show">

                <strong>{!! Session::get('message.error') !!}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="d-flex justify-content-around align-items-center w-100">
            <h1 class="w-100 sr-only">Buscador</h2>
            <form action="{{ route('products.index') }}" method="get" class="d-flex py-3">
                <label class="form-label sr-only" for="q">Titulo</label>
                <input id="q" class="form-control" type="search" name="q" placeholder="busqueda por titulo"
                    style="width: 850px;" value={{ $q }}>
                <button class="btn btn-primary mx-2" type="submit">Buscar</button>
            </form>
        </div>
        @if ($products->isNotEmpty())
        <div class="row d-flex justify-content-around align-items-center p-2 deleteRowMargin">
          @foreach ($products as $product)
            <div class="col-2 rounded border-secondary text-center border m-4 p-2 product-card">
              @if ($product->image != '' && file_exists('images/' . $product->image))
                @php
                  [$w, $h, $type, $attrs] = getimagesize('images/' . $product->image);
                @endphp
                <img src="{{ url('images/' . $product->image) }}" alt="{{ $product->detail }}" class="img-fluid"
                    style="max-width: 100%;">
              @endif
              
              <div class=" d-flex justify-content-between align-items-center ">
                <p class="text-break"><b>{{ $product->detail }}</b></p>
                <p class="text-left text-break">$<b>{{ $product->price }}</b></p>  
              </div>
              @forelse ($product->genres as $genre)
                <span class="badge bg-secondary text-white">{{ $genre->name }}</span>
              @empty
                <span class="badge bg-secondary text-white mt-1">Sin genero</span>
              @endforelse
                <div>
                    @if (auth()->user() != null)
                        <form action="{{ route('order.create') }}" method="post" class="product-actions d-flex align-items-center justify-content-between pt-3">
                        @csrf
                            <div class="input-group input-group-sm w-50">
                                <button class="btn btn-outline-secondary btn-sm" type="button" onclick="subtractQuantity(this)">-</button>
                                <input id="quantity_{{ $product->id_product }}" name="quantity" min="1" value="1" class="form-control text-center" type="number">
                                <button class="btn btn-outline-secondary btn-sm" type="button" onclick="addQuantity(this)">+</button>
                            </div>
                            <label class="form-label sr-only" for="id_user">user</label>
                            <input id="id_user_{{ $product->id_product }}" class="form-control sr-only" type="text" name="id_user" value="{{ auth()->user()->id }}">
                            <label class="form-label sr-only" for="id_product">product</label>
                            <input id="id_product_{{ $product->id_product }}" class="form-control sr-only" type="text" name="id_product" value="{{ $product->id_product }}">
                            <button class="btn btn-info btn-sm ml-2" type="submit">Agregar</button>
                            <a class="btn btn-secondary btn-sm mr-2" href="{{ route('products.show', ['id' => $product->id_product]) }}">Ver</a>
                        </form>
                      @else
                      <a class="btn btn-secondary w-100 mt-2" href="{{ route('products.show', ['id' => $product->id_product]) }}">Ver</a>
                      @endif
                </div>
            </div>
          @endforeach
        </div>
    @else
        <div class="text-center font-weight-bold p-5">NO HAY PRODUCTOS PARA MOSTRAR</div>
    @endif
@endsection
<script>
  function subtractQuantity(button) {
    let input = button.nextElementSibling;
    let quantity = parseInt(input.value);
    if (quantity > 1) {
      input.value = quantity - 1;
    }
  }

  function addQuantity(button) {
    let input = button.previousElementSibling;
    let quantity = parseInt(input.value);
    input.value = quantity + 1;
  }
</script>