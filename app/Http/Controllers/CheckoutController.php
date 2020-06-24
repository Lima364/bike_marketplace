<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;
use App\Store;
use App\UserOrder;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
// use Exception;


class CheckoutController extends Controller
{
    public function index()
    {
        // session()->forget('pagseguro_session_code');
        try
        {
            if(!auth()->check())
            {
                return redirect()->route('login');
            }
    
            if(!session()->has('cart')) return redirect()->route('home');
    
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
            print 'checkout';
        } 
        catch (\Exception $e)
        {
            session()->forget('pagseguro_session_code');
            redirect()-route('checkout.index');
        }
    }

    public function proccess(Request $request)
    {
        // dd($request->all());
        try
        {
            $dataPost = $request->all();
            $user = auth()->user();
            $cartItems = session()->get('cart');
            $stores = array_unique(array_column($cartItems, 'store_id'));
            $reference = Uuid::uuid4();
  
            $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference); 
            $result = $creditCardPayment->doPayment();
            var_dump($result);
            
            $userOrder = 
            [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
            ];
            // dd($userOrder);

            $userOrder = $user->orders()->create($userOrder);
		    $userOrder->stores()->sync($stores);


            /** NOtificar Loja de novo pedido */
            $store = (new Store())->notifyStoreOwers($stores);
           
            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            // $userOrder->orders()->create($userOrder);
            
    
            return response()->json
            ([
                'data'=> 
                [
                    'status'=>true,
                    'message'=>'Pedido criado com Sucesso !!!',
                    'order' => $reference
                ]
            ]);
        } catch(\Exception $e)
        {
            $message = env('APP_DEBUG') ? simplexml_load_string( $e->getMessage()) : 'Erro ao processar Pedido!';
            return response()->json
            ([
                'data'=> 
                [
                    'status'=>false,
                    'message'=>$message
                ]
                ], 401);
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function notification()
    {
    	try{
		    $notification = new Notification();
            $notification = $notification->getTransaction();
            
            //  atualizar o pedido do usuário
            //  comentários sobre pedido pago.
             

			$reference = base64_decode($notification->getReference());

		    $userOrder = UserOrder::whereReference($reference);
		    $userOrder->update([
			    'pagseguro_status' => $notification->getStatus()
		    ]);

		    if($notification->getStatus() == 3) {
			    // Liberar o pedido do usuário..., atualizar o status do pedido para em separação
			    //Notificar o usuário que o pedido foi pago...
			    //Notificar a loja da confirmação do pedido...
		    }

		    return response()->json([], 204);

	    } catch (\Exception $e) {
			$message = env('APP_DEBUG') ? $e->getMessage() : '';

		    return response()->json(['error' => $message], 500);
	    }
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

    // public function notification()
    // {
    // 	try{
	// 	    $notification = new Notification();
	// 	    $notification = $notification->getTransaction();

	// 		$reference = base64_decode($notification->getReference());

	// 	    $userOrder = UserOrder::whereReference($reference);
	// 	    $userOrder->update([
	// 		    'pagseguro_status' => $notification->getStatus()
	// 	    ]);

	// 	    if($notification->getStatus() == 3) {
	// 		    // Liberar o pedido do usuário..., atualizar o status do pedido para em separação
	// 		    //Notificar o usuário que o pedido foi pago...
	// 		    //Notificar a loja da confirmação do pedido...
	// 	    }

	// 	    return response()->json([], 204);

	//     } catch (\Exception $e) {
	// 		$message = env('APP_DEBUG') ? $e->getMessage() : '';

	// 	    return response()->json(['error' => $message], 500);
	//     }
    // }


}

