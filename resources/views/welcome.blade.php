@extends('layouts.front')

@section('content')
    <div class="row front">
        @foreach($products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 97%;">
                    @if($product->photos->count())
                        <img src="{{asset('storage/' . $product->photos->first()->image)}}" alt="card-img-top">
                    @else
                        <img src="{{asset('assets/img/no-photo.jpg')}}" alt="card-img-top">
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

@endsection


<?php
// <!-- <!DOCTYPE html>
// <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
//     <head>
//         <meta charset="utf-8">
//         <meta name="viewport" content="width=device-width, initial-scale=1">

//         <title>Laravel</title> -->

// <!-- Fonts -->
// <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> -->

// <!-- Styles -->
// <!-- <style>
//             html, body {
//                 background-color: #fff;
//                 color: #636b6f;
//                 font-family: 'Nunito', sans-serif;
//                 font-weight: 200;
//                 height: 100vh;
//                 margin: 0;
//             }

//             .full-height {
//                 height: 100vh;
//             }

//             .flex-center {
//                 align-items: center;
//                 display: flex;
//                 justify-content: center;
//             }

//             .position-ref {
//                 position: relative;
//             }

//             .top-right {
//                 position: absolute;
//                 right: 10px;
//                 top: 18px;
//             }

//             .content {
//                 text-align: center;
//             }

//             .title {
//                 font-size: 84px;
//             }

//             .links > a {
//                 color: #636b6f;
//                 padding: 0 25px;
//                 font-size: 13px;
//                 font-weight: 600;
//                 letter-spacing: .1rem;
//                 text-decoration: none;
//                 text-transform: uppercase;
//             }

//             .m-b-md {
//                 margin-bottom: 30px;
//             }
//         </style>
//     </head>
//     <body>
//         <div class="flex-center position-ref full-height">
//             @if (Route::has('login'))
//                 <div class="top-right links">
//                     @auth
//                         <a href="{{ url('/home') }}">Home</a>
//                     @else
//                         <a href="{{ route('login') }}">Login</a>

//                         @if (Route::has('register'))
//                             <a href="{{ route('register') }}">Register</a>
//                         @endif
//                     @endauth -->
// <!-- /* controla se o usuário está apenas acessando ou está logado mesmo */
//                     @guest
//                     <h1>Usuário não Logado</h1>
//                     @else
//                     <h1>Usuário Logado</h1>
//                     @endguest -->


// <!-- </div>
//             @endif

//             <div class="content">
//                 <div class="title m-b-md">
//                       Laravel - Testando {{$helloWorld}}
//                 </div>

//                 <div class="links">
//                     <a href="https://laravel.com/docs">Docs</a>
//                     <a href="https://laracasts.com">Laracasts</a>
//                     <a href="https://laravel-news.com">News</a>
//                     <a href="https://blog.laravel.com">Blog</a>
//                     <a href="https://nova.laravel.com">Nova</a>
//                     <a href="https://forge.laravel.com">Forge</a>
//                     <a href="https://vapor.laravel.com">Vapor</a>
//                     <a href="https://github.com/laravel/laravel">GitHub</a>
//                 </div>
//             </div>
//         </div>
//     </body>
// </html> --> 
?> 