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
})->name('home');

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

    // como eu faria pra pegar a loja de um usuario
    // $user = \App\User::find(4)

    // dd($user->store()->count()); //o objeto único  (Store) se for Collection de Dados(Objetos)

    // pegar os produtos de uma loja 
    // $loja = \App\Store::find(1);
    //return $loja->products(); $loja->products()->where('id,1')->get();   

    // criar uma loja para um usuário
    // $user = \App\User::find(10);
    // $store = $user->store()->create([
    //     'name' => 'Lota Teste',
    //     'description' => 'LOja teste de produtos de informática',
    //     'mobile_phone' => 'xx-xxxxx-xxxx',
    //     'phone' => 'xx-xxxxx-xxxx',
    //     'slug' => 'loja-teste'


    // ]);

    // dd($store);

    //posso acessar a ligacao store

    // criar um produto para uma loja
    // $store = \App\Store::find(23);
    // $product = $store->products()->create([
    //     'name' => 'NoteBook Dell',
    //     'description' => 'Core I5 10 GB',
    //     'body' => 'qq coisa ..........................',
    //     'price' => 2999.90,
    //     'slug' => 'notebook-dell'
    // ]);

    // dd($product);



    // criar uma categoria 
    // $category = \App\Category::create([
    //     'name' => 'Games',
    //     'description' => null,
    //     'slug' => 'games'
    // ]);

    // $category = \App\Category::create([
    //     'name' => 'NoteBook',
    //     'description' => null,
    //     'slug' => 'notebook'
    // ]);

    // return \App\Category::all();



    // adicionar um produto para uma categoria ou vice e versa
    $product = \App\Product::find();

    dd($product->categories()->attach([])); // adicionado na base
    // para remover se usa o detach

    //** a melhor opçao é usar o sync pq se ele não tem nada ele coloca e se já tiver ele tira */

    return \App\User::all();
});

//pegar as lojas de uma categorias de uma loja
// $categoria = \App\Category::find(1);
// $categoria->products;

// Route::get('/model', function () {



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




// });


// o laravel irá responder diretamente para as rotas:
//Route::get
//Route::post
//Route::put
//Route::patch
//Route::delete
//Route::options



Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
        // Route::prefix('stores')->name('stores.')->group(function()
        // {
        //     Route::get('/', 'StoreController@index')->name('index');
        //     Route::get('/create', 'StoreController@create')->name('create');
        //     // aqui deixa de ser get e passa a ser post porque vem do formulário    
        //     Route::post('/store', 'StoreController@store')->name('store'); 

        //     Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
        //     Route::post('update/{store}', 'StoreController@update')->name('update'); 

        //     Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
        // });
        // linhas comentadas acima pq haverá um resource 
        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
    });
});

Auth::routes();
//após atualização do app.blade no menu estou tirando esta rota abaixo - usarei a rota home lá de cima
// Route::get('/home', 'HomeController@index')->name('home');
