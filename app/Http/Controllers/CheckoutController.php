<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // session()->forget('pagseguro_session_code');
        if(!auth()->check())
        {
            return redirect()->route('login');
        }

        $this->makePagSeguroSession();
        // var_dump(session()->get('pagseguro_session_code'));

        // dd($this->makePagSeguroSession());

        // $total = 0
        $cartItems = array_map(function($line)
        {
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);
        
        // dd($cartItems);

        return view('checkout', compact('cartItems'));
        // print 'checkout';
    }

    public function proccess(Request $request)
    {
        // dd($request->all());

        $dataPost = $request->all();
        $cartItems = session()->get('cart');
        $reference = 'XPTO';
        $user = auth()->user();

        $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference); 
        $result = $creditCardPayment->doPayment();
        // var_dump($result);
        
        $userOrder = 
        [
            'reference' =>$reference,
            'pagseguro_code' => $result->getCode(),
            'pagseguro_status' => $result->getStatus(),
            'items' => serialize($cartItems),
            'store_id' => 27
        ];

        $user->orders()->create($userOrder);

        return response()->json
        ([
            'data'=> 
            [
                'status'=>true,
                'message'=>'Pedido criado com Sucesso !!!'
            ]
        ]);

    }

    private function makePagSeguroSession()
    {
        if(!session()->has('pagseguro_session_code'))
        {
                // session()->forget('pagseguro_session_code');
                $sessionCode = \PagSeguro\Services\Session::create(
                    \PagSeguro\Configuration\Configure::getAccountCredentials());
                    
                    // print $sessionCode->getResult();

                    return session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
