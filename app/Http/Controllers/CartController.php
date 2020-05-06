<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/** verificar se existe sessão para os produtos
 * se existir, adiciono  o produto na sessão existente
 * se não existir a sessão de produtos eu a crio com o primeiro produto
 */
class CartController extends Controller
{
    public function add(Request $request)
    {
        $productData = $request->get('product');

        $product = \App\Product::whereSlug($productData['slug']);

        if(!$product->count() || $productData['amount'] == 0)
        {
            return redirect()->route('home');

           $product = array_merge($productData, $product->first(['name', 'price', 'store_id'])->toArray());

            if(session()->has('cart')) 
            {
                $products = session()->get('cart');
                $productsSlugs = array_column($products, 'slug');

                if(in_array($product['slug'], $productsSlugs)) {
                    $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                    session()->put('cart', $products);
            } else 
            {
                session()->push('cart', $product);
            }

        } else 
        {
            $products[] = $product;
            session()->put('cart', $products);
        }

        flash('Produto Adicionado no carrinho')->success();
        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(session()->get('cart'));
        
        $cart = session()->has('cart') ? session()->get('cart') : [];

        return view('cart', compact('cart'));
    }

    /**
     * Add products into cart
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove a item from cart
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function remove($slug)
    {
        if(!session()->has('cart')) {
            return redirect()->route('cart.index');
        }

        $products = session()->get('cart');

        $products = array_filter($products, function($line) use($slug) {
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);
        return redirect()->route('cart.index');
    }

    /**
     * Remove all itens into cart
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        session()->forget('cart');

        flash('Compra cancelada!')->success();
        return redirect()->route('cart.index');
    }

    /**
     *
     * @param string $slug
     * @param int $amount
     * @param array $products
     *
     * @return array
     */
    private function productIncrement($slug, $amount, $products)
    {
        $products = array_map(function($line) use($slug, $amount){
            if($slug == $line['slug']) {
                $line['amount'] += $amount;
            }
            return $line;
        }, $products);

        return $products;
    }
}

