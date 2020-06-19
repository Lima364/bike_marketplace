@extends('layouts.front')

@section('content')
    <div class="row front">
        @foreach($products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 97%;">
                    @if($product->photos->count())
                        <img src="{{asset('storage/' . $product->thumb)}}" alt="card-img-top" width=40% height=80%>
                    @else
                        <img src="{{asset('assets/img/semfoto1.jpg')}}" alt="card-img-top" width= 40% height= 80%>
                    @endif
                    
                    <div class="card-body">
                        <h2 class="card-title">{{$product->name}}</h2>
                        <p class="card-text">{{$product->description}}</p>
                        <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success">
                            Ver Produto
                        </a>
                    </div>
                </div>
            </div>
            @if(($key + 1) % 3 == 0) </div><div class="row front"> @endif
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            <h2>Lojas Destaque</h2>
            <hr>
        </div>
        @foreach ($stores as $store)
        <div class="col-md-4">
            @if($store->logo)
                     <img src="{{asset('storage/' . $store->logo)}}" alt="Logo da Loja {{$store->name}}" class="img-fluid" width=100% height=auto>
                @else
                        <img src="{{asset('assets/img/semlogo1.jpg')}}" alt="card-img-top" width= 30% height= 60%>

                    {{-- <img src="https://via.placeholder.com/256X197.png?text=logo" alt="Loja sem logo........!! {{$store->name}}" class="img-fluid" width=50% height=100%> --}}
            @endif
            <h3>{{$store->name}}</h3>
            <p>{{$store->description}}</p>
            <a href="{{route('store.single', ['slug' => $store->slug])}}" class="btn btn-sm btn-success">Ver Loja</a>
        </div>
        @endforeach
    </div>
@endsection