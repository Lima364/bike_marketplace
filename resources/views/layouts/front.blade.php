<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bike MarketPlace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> -->
    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
    @yield('stylesheets')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">

    <a class="navbar-brand" href="{{route('home')}}">Bike MarketPlace</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('/')) active @endif">
                <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            @foreach ($errors as $category)
                <li class="nav-item @if(request()->is('category/' . $category->slug)) active @endif">
                    <a class="nav-link" href="{{route('category.single', ['slug' => $category->slug])}}">{{$category->name}}</a>
                </li>
            @endforeach
        </ul>

    @auth
    
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                <a class="nav-link" href="{{route('admin.stores.index')}}">Lojas<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
            </li>
            <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
            </li>
        </ul>

    @endauth

        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                @auth
                    <li class="nav-item @if(request()->is('user.orders*')) active @endif">
                        <a href="{{route('user.orders')}}" class="nav-link">Meus Pedidos</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a href="{{route('cart.index')}}" class="nav-link">
                        @if (session()->has('cart'))
                            @php 
                                // para contar a quantidade comprada independente dos itens
                                // <!-- <span class="badge badge-danger">{{array_sum(array_column(session()->get('cart'), 'amount'))}}</span> -->
                                // implementar depois o total de de produtos comprados
                                // testar depois - {{array_sum(array_column(session()->get('cart'), 'amount'))}} 
                                // contador de produtos/itens do carrinho 
                            @endphp
                            <span class="badge badge-danger">{{count(session()->get('cart'))}}</span>
                        @endif
                    <i class="fa fa-shopping-cart fa-2x"></i>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>

<div class="container">
    @include('flash::message')
    @yield('content')
</div>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" ></script>
    <script src="{{asset('js/app.js')}}"></script>

@yield('scripts')
</body>
</html>