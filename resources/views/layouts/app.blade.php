<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike MarketPlace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <link rel="stylesheet" href="style.css"></link>  -->
    <!-- para chamada de um css externo -->

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>

<body>
    <!--  /* troquei o 'navbar-light' pelo 'navbar-dark' e o 'bg-light' pelo bg-dark*/ -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 50px;">
        <a class="navbar-brand" href="{{route('home')}}">Bike MarketPlace</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('admin/orders*')) active @endif">
                    <a class="nav-link" href="{{route('admin.orders.my')}}">Meus Pedidos</a>
                </li>
            <!-- este asterisco colocado após o stores e products diz ao request que ele precisa retornar verdadeiro -->
                <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                    <a class="nav-link" href="{{route('admin.stores.index')}}">Loja</a>
                </li>
                <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                    <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
                </li>
                <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                    <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
                </li>
            </ul>

            <div class="my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="{{route('admin.notifications.index')}}" class="nav-link">
                            <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                            <i class="fa fa-bell"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="#">Sair</a> -->
                        <!-- quando eu clicar neste botão (propriedade onclick) vou procurar aqui a classe logout
                    e faço um 'submit' e o 'form' será enviado pra rota logout usando o método 'POST'-->
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit()" ;>Sair</a>
                        <form action="{{route('logout')}}" class="logout" method="POST" style="display:none; ">
                            @csrf
                        </form>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">{{auth()->user()->nome}}</span>
                    </li>
            
                </ul>
            </div>
            @endauth
        </div>
    </nav>
    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js" ></script> -->
    <script src="{{asset('js/app.js')}}"></script>
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

</body>

</html>


<!-- <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
                </li> -->
<!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Ação</a>
                        <a class="dropdown-item" href="#">Outra ação</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Algo mais aqui</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Desativado</a>
                </li> -->