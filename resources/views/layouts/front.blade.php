<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bike MarketPlace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        .front.row {
            margin-bottom: 40px;
        }

        .badge-notify{
            background:#4CD964;
            position:relative;
            top: -15px;
            left: -16px;
        }
    </style>
    @yield('stylesheets')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">

    <a class="navbar-brand" href="{{route('home')}}">Bike MarketPlace</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" ></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('/')) active @endif">
                <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
           
            @foreach ($categories as $category)
                <li class="nav-item @if(request()->is('category/' . $category->slug)) active @endif">
                    <a class="nav-link" href= "{{route('category.single', ['slug' => $category->slug])}}">{{$category->name}}</a>
                </li>
            @endforeach
        </ul>
    
        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                @auth
                {{-- @php var_dump($log) @endphp --}}
                    @if(auth()->user()->role == 'ROLE_OWNER')
                        <li class="nav-item @if(request()->is('my-orders')) active @endif">
                            <a href="{{route('admin.stores.index')}}" class="nav-link">Admin</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit()" ;>Sair</a>

                        <form action="{{route('logout')}}" class="logout" method="POST" style="display:none; ">
                            @csrf
                        </form>
                    </li>
                @endauth
                <li class="nav-item @if(request()->is('/')) active @endif">
                    <a class="nav-link" href="{{route('login')}}">Login<span class="sr-only">(current)</span></a>
                </li>         
                <li class="nav-item @if(request()->is('/')) active @endif">
                    <a class="nav-link" href="{{route('register')}}">Registro <span class="sr-only">(current)</span></a>
                </li>    
         
                <li class="nav-item">
                    <a href="{{route('cart.index')}}" class="nav-link">
                        @if (session()->has('cart'))
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
   
   {{-- tentar desativar este script qd for testar 
   testa com e testar sem --}}

    {{-- <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script> --}}

    <script src="{{asset('js/app.js')}}"></script>
    
@yield('scripts')

</body>
</html>
