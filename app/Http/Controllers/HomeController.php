<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth'); /*verifica se o usuário está logado ou não - o middleware 
    //     é um meio pra esta verificação acontecer*/
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->product->limit(8)->orderBy('id', 'DESC')->get();
        // dd($products);
        return view('welcome', compact('products'));
        // return view('home');
    }

    public function single($slug)
    {
        /**uso no where Slug com letra maiuscula pq o Laravel já entende que é o campo */
        $product = $this->product->whereSlug($slug)->first;
        return view('single', compact('product'));
        // print $slug;
    } 
}

/* 
Middlewares: Dentro de aplicações web, ele é um código ou programa que é executado entre
a requisição (Request) e a aplicação - é a lógica executada pelo acesso a uma determinada
rota.

Aplicação <- Marketplace

Request -> Middleware -> aplicação -acesso qualquer rota - <- Marketplace
*/




/* O que que é o middleware na verdade - middleware a gente tem aqui a 
nossa aplicação que é o Marketplace. E tem na arquitetura web uma request que 
aponta para a nossa aplicação. Toda vez que acesso qualquer ponto da aplicação 
ou seja, acesso qualquer rota, eu estarei fazendo uma request, estarei fazendo 
uma requisição para aquele ponto em questão. E nesses acessos a gente disponibiliza
 rotas para serem acessadas. E aonde é que esse tal de middleware ele se encaixa?
 o middleware dentro da de aplicações web ele é um código ou programa que é executado 
 entre a requisição - 'request' - e a nossa aplicação. A nossa aplicação nesse caso 
 que me refiro é a lógica executada pelo acesso a uma determinada ao rota.
 O Middleware sempre será essa aplicação no meio e esse meio fica entre o acesso 
 a tua aplicação e a tua aplicação de fato, que dado os acessos é à execução do que 
 aquela rota tem, ou seja, um método de um controller ou a própria função anônima 
 como a gente já conhece. E como ele é um executado antes de chegar no nosso código 
 de fato, eu posso utilizar desse pensamento de middleware para saber se o usuário 
 está autenticado ou não quando eu quero que uma determinada rota esteja disponível 
 somente para usuários autenticados. Que no caso se aplica as nossas rotas do administrativo,
  só pessoas devidamente cadastradas podem acessar as rotas que estão no administrativo,
ou seja, elas tem um login e uma senha para acessar. Os middlewares são perfeitos 
para gente verificar se usuário está logado ou não dentro da nossa aplicação.
 Então middlewares irão agir neste ponto aqui (Request -> Middleware -> aplicação)
Isso se você adicionar um middleware naquele momento ali para ser chamado, caso ele 
não for chamado não vão ter middlewares Mas se tiver eles vão estar entre a requisição
 e a tua aplicação que é o ponto de execução de qualquer rota. */