<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Product;
// use \App\Store;
use \App\Http\Requests\ProductRequest;
use App\Traits\UploadTrait;
class ProductController extends Controller
{
    use UploadTrait;

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
        // dd(auth()->user()->store()->exists());
        // $userStore = auth()->user()->store;
        $user = auth()->user();
        // dd($user);

        // dd($userStore);
        if(!$user->store()->exists())
        {
            flash('É preciso criar uma loja para cadastrar produtos')->warning();
            return redirect()->route('admin.stores.index');
        }
        $products = $user->store->products()->paginate(10);
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
        
        // $images = $request->file('photos');
        // foreach($images as $image)
        // {   // metodo chamado 'store' que recebe o nome da pasta que quero armazenar a foto pasta 
        //     // 'products' e onde quero armazenar esta pasta que será o disco escolhido 'public'
        //     // criará dentro da pasta 'storage/app/public em uma pasta 'products' com este arquivo
            
        //     $images->store('products', 'public');
        // }

        // dd($request->file('photos'));
        $data=$request->all();
        $categories = $request->get('categories', null);
        $data['price'] = formatPriceToDatabase($data['price']);

        /** ================================ */
        // $data['slug'] = $data['name'];       
        /** ================================ */

        // dd($data['price']);

        // $store = \App\Store::find($data['store']); trocado pela associação abaixo
        /** estou acessando a loja do usuário autenticado */
        $store = auth()->user()->store;
        /** por meio desta loja eu crio o produto pra esta loja - o método 'create' retorna um objeto populado
         * com as informações deste produto criado inclusive com o 'id' - na variável 'produto' eu pego a ligação
         * deste produto com categoria e fazer o save destas categorias para este produto fazendo as ligações na
         * tabela intermediária
         */
        $product = $store->products()->create($data);
        $product->categories()->sync($categories);

        if($request->hasFile('photos'))
        {
            $images = $this->imageUpload($request->file('photos'), 'image');
            /** inserção destas imagens/referencia na minha base */

            $product->photos()->createMany($images);
            /** retirado do comando acima por causa dos novos acessos criados - ['image'=> 'nome_da_foto.png'], ['image'=> 'nome_da_foto.png'] */
        }

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
        // $categories = \App\Store::all(['id', 'name']);
        $categories = \App\Category::all(['id', 'name']);

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
        $categories = $request->get('categories', null);

        $product = $this->product->find($product);
        $product->update($data);

        if(!is_null($categories))
        // {
        $product->categories()->sync($categories);
        // }
        if($request->hasFile('photos'))
        {
            $images = $this->imageUpload($request->file('photos'), 'image');
            $product->photos()->createMany($images);
        }
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
     
        // dd($product);

        $product->delete();

        flash('Produto Removido com Sucesso!')->success();
        return redirect()->route('admin.products.index');
        // return $product;
    }
   
}
