<?php

namespace App\Http\Controllers;

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

//     public function proccess(Request $request)
//     {
//         // dd($request->all());
//         $dataPost = $request->all();

//         $reference = 'XPTO';
//         //Instantiate a new direct payment request, using Credit Card
//         $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

//         /**
//          * @todo Change the receiver Email
//          */
//         /** entra aqui meu email como recebedor */
//          $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));

//         // Set a reference code for this payment request. It is useful to identify this payment
//         // in future notifications.
//         /** código gerado por mim */
//         $creditCard->setReference($reference);

//         // Set the currency
//         $creditCard->setCurrency("BRL");

//         $cartItems=session()->get('cart');

//         foreach($cartItems as $item)
//         {
//             // Add an item for this payment request
//             $creditCard->addItems()->withParameters(
//                 $reference,
//                 $item['name'],
//                 $item['amount'],
//                 /** passo apenas o valor unitário e o valor total o pagseguro gera*/
//                 $item['price']
//             );
//         }

//         // Set your customer information.
//         // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
//         $user = auth()->user();
//         $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;

//         $creditCard->setSender()->setName($user->name);
//         $creditCard->setSender()->setEmail($email);
// /** =================================================================================== */
// /** Depois incluir a entrada e confirmação do telefone, endereço, cpf e ip do comprador */
//         $creditCard->setSender()->setPhone()->withParameters(
//             11,
//             56273440
//         );

//         $creditCard->setSender()->setDocument()->withParameters(
//             'CPF',
//             '39201666047'
//         );

//         $creditCard->setSender()->setHash($dataPost['hash']);

//         $creditCard->setSender()->setIp('127.0.0.0');

//         // Set shipping information for this payment request
//         $creditCard->setShipping()->setAddress()->withParameters(
//             'Av. Brig. Faria Lima',
//             '1384',
//             'Jardim Paulistano',
//             '01452002',
//             'São Paulo',
//             'SP',
//             'BRA',
//             'apto. 114'
//         );

//         //Set billing information for credit card
//         $creditCard->setBilling()->setAddress()->withParameters(
//             'Av. Brig. Faria Lima',
//             '1384',
//             'Jardim Paulistano',
//             '01452002',
//             'São Paulo',
//             'SP',
//             'BRA',
//             'apto. 114'
//         );

//         // Set credit card token
//         $creditCard->setToken($dataPost['card_token']);

//         list($quantity, $installmentAmount) = explode('|', $dataPost['installment']);

//         // Set the installment quantity and value (could be obtained using the Installments
//         // service, that have an example here in \public\getInstallments.php)
//         $installmentAmount = number_format($installmentAmount, 2, '.', '');

//         $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

//         // Set the credit card holder information
// /** =================================================================================== */
// /** pedir e tratar a data de aniversário do comprador */
//         $creditCard->setHolder()->setBirthdate('01/10/1979');

//         $creditCard->setHolder()->setName($dataPost['card_name']); // Equals in Credit Card

//         $creditCard->setHolder()->setPhone()->withParameters(
//             11,
//             56273440
//         );

//         $creditCard->setHolder()->setDocument()->withParameters(
//             'CPF',
//             '39201666047'
//         );

//         // Set the Payment Mode for this payment request
//         $creditCard->setMode('DEFAULT');

//         // Set a reference code for this payment request. It is useful to identify this payment
//         // in future notifications.

//         //Get the crendentials and register the boleto payment
//         $result = $creditCard->register(
//             \PagSeguro\Configuration\Configure::getAccountCredentials()
//         );

//         // var_dump($result);

//         $userOrder = 
//         [
//             'reference' =>$reference,
//             'pagseguro_code' => $result->getCode(),
//             'pagseguro_status' => $result->getStatus(),
//             'items' => serialize($cartItems),
//             'store_id' => 42
//         ];

//         $user->orders()->create($userOrder);

//         return response()->json
//         ([
//             'data'=> 
//             [
//                 'status'=>true,
//                 'message'=>'Pedido criado com Sucesso'
//             ]
//         ]);

//     }

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
