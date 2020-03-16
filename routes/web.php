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

Route::get('/', function () {
    $helloWorld = "Hello World";
    return view('welcome', ["helloWorld" => "$helloWorld"]);
});

// Route::get('/model', function(){
//     $products = \App\Product::all(); // tradução select * from products
//     return $products;
// });

Route::get('/model', function () {
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


    // Mass Assignment ou Atribuição em Massa

    // $user = \App\User::create([
    //     'name' => 'Nanderson Castro',
    //     'email' => 'bola100@email.com',
    //     'password' => bcrypt('12345678')
    // ]);
    // dd($user);


    // Mass Update

    // $user = \App\User::find(43);
    // $user = $user->update([
    //     'name' => 'Atualizando com Mass Update'
    // ]); // irá retornar true ou false
    // dd($user);

    // return \App\User::paginate(10);
    return \App\User::all();
});


Route::get('/model', function () {

    // $products = \App\Product::all(); //select *from products
    // return $products;
    // // descrito abaixo é o AR active record - Esta é uma das formas que voce pode utilizar pra criar o seu dado, para inserção de dados

    // $user = new \App\User();
    // $user->name = '';
    // $user->email = '';
    // $user->password = bcrypt('12345678');
    // $user->save();


    // return $user->save(); // esta função retorna um booleano
    //\App\user::all() - retorna todos os usuários
    //\App\user::find() - retorna o usuário baseado no id

    // return \App\User::where('name', 'Cristede....')->get(); // select * from users where 'name' seja igual a condicional
    // // esta query com condição eu preciso pegar com método 'get'

    // return \App\User::where('name', 'Cristede....')->first(); // select * from users where 'name' seja igual a condicional mas só o primeiro



  
    

});
