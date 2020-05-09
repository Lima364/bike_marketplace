@extends('layouts.front')

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
                    <label for="">Número do Cartão</label>
                    <input type="text" class="form-control" name="card_number">
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
            </div>
            <button class="btnbtn-success btn-lg">Efetuar Pagamento</button>            
        </form>

    </div>
    


</div>







@endsection
