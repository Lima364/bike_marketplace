@extends('layouts.front')

@section('content')
    <div class="row front">
        <div class="col-4">
            @if($store->logo)
                <img src="{{asset('storage/' . $store->logo)}}" alt="Logo da Loja {{$store->name}}" class="img-fluid">
            @else
            <img src="https://via.placeholder.com/256X197.png?text=logo" alt="Loja sem Logo...{{$store->name}}" class="img-fluid">
            @endif
        </div>
        <div class="col-8">
            <h2>{{$store->name}}</h2>
            <p>{{$store->description}}</p>
            <p>
                <strong>Contatos:</strong>
                <span>{{$store->phone}}</span> | <span>{{$store->mobile_phone}}</span>
            </p>
        </div>
        
        <div class="col-12">
            <hr>
            <h3 style="margin-bottom: 40px">Produtos dessa Loja</h3>
        </div>
        @forelse($store->products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 97%;">
                    @if($product->photos->count())
                        <img src="{{asset('storage/' . $product->photos->first()->image)}}" alt="img-fluid" width=40% height=80%>
                    @else
                        <img src="{{asset('assets/img/no-photo.jpg')}}" alt="card-img-top"  width=40% height=80%>
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
        @empty
            <div class="col-12">
                <h3 class="alert alert-warning">Desculpe, mas não há produtos cadastrados nesta loja!</h3>                
            </div>
        @endforelse
    </div>
@endsection