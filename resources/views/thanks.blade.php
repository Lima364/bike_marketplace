@extends('layouts.front')

@section('content')

    <h2 class="alert alert-success">
        Muito obrigado por ter comprado conosco!
    </h2>
    <h3>
        Seu pedido foi processado, código do pedido: {{ request()->get('order') }}.
    </h3>

@endsection
