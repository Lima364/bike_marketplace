@extends('layouts.front')

@section('content')
    <div class="row front">
        <div class="col-12">
            <h2>{{$category->name}}</h2>
            <hr>
        </div>
        @forelse($category->products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 97%;">
                    @if($product->photos->count())
                        <img src="{{asset('storage/' . $product->photos->first()->image)}}" alt="card-img-top" width=40% height=80%>
                        {{-- testar alt="" class="card-img-top"> aqui e emabaixo --}}
                    @else
                        <img src="{{asset('assets/img/semfoto1.jpg')}}" alt="card-img-top" width=40% height=80%>
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
                <h3 class="alert alert-warning">Desculpe, mas não há produtos cadastrados nesta categoria!</h3>                
            </div>
        @endforelse
    </div>
@endsection