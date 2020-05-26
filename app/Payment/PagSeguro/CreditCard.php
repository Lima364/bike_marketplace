<?php

namespace App\Payment\PagSeguro;

class CreditCard
{
    private $items;
    private $user;
    private $cardInfo;
    private $reference;

    public function __construct($items, $user, $cardInfo, $reference)
    {
        $this->items = $items;
        $this->user = $user;
        $this->cardInfo = $cardInfo;
        $this->reference = $reference;
    }
    /** processo de pagamento que estava a principio no CheckoutController */
    public function doPayment()
    {
        // $reference = 'XPTO';
        //Instantiate a new direct payment request, using Credit Card
        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

        /**
         * @todo Change the receiver Email
         */
        /** entra aqui meu email como recebedor */
         $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));

        // Set a reference code for this payment request. It is useful to identify this payment
        // in future notifications.
        /** código gerado por mim */
        $creditCard->setReference($this->reference);

        // Set the currency
        $creditCard->setCurrency("BRL");

        // $cartItems=session()->get('cart');

        foreach($this->items as $item)
        {
            // Add an item for this payment request
            $creditCard->addItems()->withParameters(
                $this->reference,
                $item['name'],
                $item['amount'],
                /** passo apenas o valor unitário e o valor total o pagseguro gera*/
                $item['price']
            );
        }

        // Set your customer information.
        // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
        // $user = auth()->user();
        $user = $this->user;

        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;

        $creditCard->setSender()->setName($user->name);
        $creditCard->setSender()->setEmail($email);
/** =================================================================================== */
/** Depois incluir a entrada e confirmação do telefone, endereço -de entrega e do cartão, cpf e ip do comprador 
 * pegar data de nascimento 
*/
        $creditCard->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setSender()->setDocument()->withParameters(
            'CPF',
            '39201666047'
        );

        $creditCard->setSender()->setHash($this->cardInfo['hash']);

/** ver como pegar o IP do usuário e colocar aqui. */ 
        // $creditCard->setSender()->setIp('127.0.0.0');

        // Set shipping information for this payment request
        $creditCard->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        //Set billing information for credit card
        $creditCard->setBilling()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        // Set credit card token
        $creditCard->setToken($this->cardInfo['card_token']);

        list($quantity, $installmentAmount) = explode('|', $this->cardInfo['installment']);

        // Set the installment quantity and value (could be obtained using the Installments
        // service, that have an example here in \public\getInstallments.php)
        $installmentAmount = number_format($installmentAmount, 2, '.', '');

        $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

        // Set the credit card holder information
/** =================================================================================== */
/** pedir e tratar a data de aniversário do comprador */
        $creditCard->setHolder()->setBirthdate('01/10/1979');

        $creditCard->setHolder()->setName($this->cardInfo['card_name']); // Equals in Credit Card

        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setHolder()->setDocument()->withParameters(
            'CPF',
            '39201666047'
        );

        // Set the Payment Mode for this payment request
        $creditCard->setMode('DEFAULT');

        // Set a reference code for this payment request. It is useful to identify this payment
        // in future notifications.

        //Get the crendentials and register the boleto payment
        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        return $result;
    }


}