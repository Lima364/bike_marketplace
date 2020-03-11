<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// use Illuminate\Routing\Route;

Route::get('/', function() {
    $helloWorld = "Hello World";
    return view('welcome', ["helloWorld" => "$helloWorld"]);
});

// Route::get('/model', function(){
//     $products = \App\Product::all(); // tradução select * from products
//     return $products;
// });

Route::get('/model', function(){
    // $products = \App\Product::all(); // tradução select * from products
    
    // $user = new \App\User();
    // $user->name = 'usuário teste';
    // $user->email = 'email@teste.com';
    // $user->password = bcrypt('12345678');
    // $user->save();
    // return \App\User::all(); \\retorna todos os usuários
    // return $user->save();
    // return \App\User::find(3); \\retorna determinado usuário com base no id

    // posso fazer condições
    // return \App\User::where('name','Stone Hauck')->get(); // select * from users where name = 'o valor colocado'
    
    
    // return \App\User::where('name','Stone Hauck')->first(); // para pegar o primeiro resultado pode-se usar o first

    return \App\User::paginate(10);




});

