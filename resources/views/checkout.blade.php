@extends('layouts.front')

@section('stylesheets')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')

<div class="container">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h2>Dados para Pagamento</h2>
                <hr>
            </div>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Nome igual ao do Cartão</label>
                    <input type="text" class="form-control" name="card_name">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Número do Cartão <span class="brand"></span></label>
                    <input type="text" class="form-control" name="card_number">
                    <input type="hidden" name="card_brand">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="">Mes de Expiração</label>
                    <input type="text" class="form-control" name="card_month">
                </div>

                <div class="col-md-4 form-group">
                    <label for="">Ano de Expiração</label>
                    <input type="text" class="form-control" name="card_year">
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 form-group">
                    <label for="">Código de Segurança</label>
                    <input type="text" class="form-control" name="card_cvv">
                </div>
                
                <div class="col-md-12 installments form-group">
                </div>
            </div>

            <button class="btn btn-success btn-lg processCheckout" type="submit">Efetuar Pagamento</button>  

        </form>

    </div>

</div>

@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    

    <script>
        // Set-Cookie: promo_shown=1; Max-Age=2600000; Secure;
        const sessionId = "{{session()->get('pagseguro_session_code')}}";
        const urlThanks = '{{route('checkout.thanks')}}';
        const urlProccess = '{{route("checkout.proccess")}}';
        const amoutTransaction = '{{$cartItems}}';
        const csrf = '{{csrf_token()}}';

        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script src="{{asset('js/pagseguro_functions.js')}}"></script>
    <script src="{{asset('js/pagseguro_events.js')}}"></script>

@endsection