<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;



class StoreController extends Controller
{
    public function index()
    {
        // $stores = \App\Store::all();
        $store = auth()->user()->store; // irei mostrar apenas uma loja por user e não vou paginar

        // $stores = \App\Store::paginate(8);
        // dd(auth()->user()->store);
        return view('admin.stores.index', compact('store'));
        // return $stores;
        // $stores =\App\Store::paginate(10);
        // return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        $users = \App\User::all(['id', 'name']);
        return view('admin.stores.create', compact('users'));
    }

    public function store(StoreRequest $request)
    {   
        $data = ($request->all());
        /* ao criar a loja irei buscar o usuário autenticado por meio do objeto da autenticação
        eu consigo ter acesso a este objeto por meio da função helper 'auth()' e desta função eu chamo
        um método 'user' que me trará o objeto do usuário que estará autenticado*/
        $user = auth()->user();
        // dd(auth()->user());
        // $user = \App\User::find($data['user']); com o objeto acima eu posso retirar esta linha
        
        /* o usuário que estiver autenticado eu faço a ligação dele com loja e permito a criação de 
        uma loja para este usuário */
        $store = $user->store()->create($data);

        flash('Loja Criada com Sucesso')->success();
        return redirect()->route('admin.stores.index');

        // return $store;
    }

    public function edit($store)
    {
        $store = \App\Store::find($store);
        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, $store)
    {
        // dd($request->all());
        $data = ($request->all());
        $store = \App\Store::find($store);
        $store->update($data);

        // return $store;
        flash('Loja Atualizada com Sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = \App\Store::find($store);
        $store->delete();
        
        flash('Loja Removida com Sucesso')->success();
        return redirect()->route('admin.stores.index');

    }

}
 
// /**
//  *  use App\Http\Controllers\Admin;*/
// * 
// */
