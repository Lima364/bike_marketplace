<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Product;
use \App\Http\Requests\ProductRequest;


class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userStore = auth()->user()->store;
        $products = $userStore->products()->paginate(10);
      /**   // $products =  $this->product->paginate(5); - linha substituida pela de cima */
        return view('admin.products.index', compact('products'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     /**    $stores = \App\Store::all(['id', 'name']); não precisarei disso depois pq só usuário autenticado é que pode incluir produtos */
        $categories = \App\Category::all(['id', 'name']);
        return view('admin.products.create', compact('categories'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {   
        $images = $request->file('photos');
        foreach($images as $image)
        {   // metodo chamado 'store' que recebe o nome da pasta que quero armazenar a foto pasta 
            // 'products' e onde quero armazenar esta pasta que será o disco escolhido 'public'
            // criará dentro da pasta 'storage/app/public em uma pasta 'products' com este arquivo
            

            
            $images->store('products', 'public');
        }

        // dd($request->file('photos'));
        $data=$request->all();

        // $store = \App\Store::find($data['store']); trocado pela associação abaixo
        /** estou acessando a loja do usuário autenticado */
        $store = auth()->user()->store;
        /** por meio desta loja eu crio o produto pra esta loja - o método 'create' retorna um objeto populado
         * com as informações deste produto criado inclusive com o 'id' - na variável 'produto' eu pego a ligação
         * deste produto com categoria e fazer o save destas categorias para este produto fazendo as ligações na
         * tabela intermediária
         */
        $product = $store->products()->create($data);
        $product->categories()->sync($data['categories']);

        flash('Produto Criado com Sucesso!')->success();
        return redirect()->route('admin.products.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $product = $this->product->findOrFail($product);
        $categories = \App\Store::all(['id', 'name']);
        return view('admin.products.edit', compact('product', 'categories'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */

    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();
        // $data = request->all();
        $product = $this->product->find($product);
        $product->update($data);
        $product->categories()->sync($data['categories']);
        flash('Produto Atualizado com Sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = $this->product->find($product);
        $product->delete();

        flash('Produto Removido com Sucesso!')->success();
        return redirect()->route('admin.products.index');
        // return $product;
    }
}
