function proccessPayment(token, buttonTarget)
{
    let data = {
        card_token: token,
        hash: PagSeguroDirectPayment.getSenderHash(),
        installment: document.querySelector('select.select_installments').value,
        card_name: document.querySelector('input[name=card_name]').value,
        _token: csrf
    };

    $.ajax({
        type: 'POST',
        url: urlProccess,
        data: data,
        dataType: 'json',
        success: function(res) {
            toastr.success(res.data.message, 'Sucesso');
            window.location.href = `${urlThanks}?order=${res.data.order}`;
        },
        error: function(err)
        {
            // console.log(JSON.parse(err.responseText));
            buttonTarget.disabled = false;
            buttonTarget.innerHTML = 'Efetuar Pagamento';
            let message = JSON.parse(err.responseText);
            documento.querySelector('div.msg').innerHTML = showErrorMessages(message.data.message.error.message)
        }
    });
}

function getInstallments(amount, brand) {
    PagSeguroDirectPayment.getInstallments({
        amount: amount,
        brand: brand,
        maxInstallmentNoInterest: 0,
        success: function(res) {
            let selectInstallments = drawSelectInstallments(res.installments[brand]);
            document.querySelector('div.installments').innerHTML = selectInstallments;
        },
        error: function(err) {
            console.log(err);
        },
        complete: function(res) {

        },
    })
}

function drawSelectInstallments(installments) {
    let select = '<label>Opções de Parcelamento:</label>';

    select += '<select class="form-control select_installments">';

    for(let l of installments) {
        select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
    }


    select += '</select>';

    return select;
}

function showErrorMessages(message)
{
    return `<div class="alert alert-danger">${message}</div>`;
}


function errorsMapPagseguroJS(code)
{
    switch(code) {
        case "10000":
            return 'Bandeira do cartão inválida!';
        break;

        case "10001":
            return 'Número do Cartão com tamanho inválido!';
        break;

        case "10002":
        case  "30405":
            return 'Data com formato inválido!';
        break;

        case "10003":
            return 'Código de segurança inválido';
        break;

        case "10004":
            return 'Código de segurança é obrigatório!';
        break;

        case "10006":
            return 'Tamanho do código de segurança inválido!';
        break;

        default:
            return 'Houve um erro na validação do seu cartão de crédito!';
    }
}



/**
function proccessPayment(token)
        {
            let data = 
            {
                card_token: token,
                hash: PagSeguroDirectPayment.getSenderHash(),
                installment: document.querySelector('select.select_installments').value,
                card_name: document.querySelector('input[name=card_name]').value,
                _token: '{{csrf_token()}}',
            };
          
            $.ajax(
            {
                type: 'POST',
                url: '{{route("checkout.proccess")}}',
                data: data,
                dataType: 'json',
                success: function(res)
                {
                    // console.log(res);
                    // alert(res.data.message);
                    // res.data.message;
                    toastr.success(res.data.message, 'Sucesso!!')
                    window.location.href = '{{route("checkout.thanks")}}?order=' + res.data.order; 

                }
            });
        }

        // buscando opções de parcelamento
        function getInstallments(amount, brand)
        {
            PagSeguroDirectPayment.getInstallments(
                {
                    amount: amount,
                    brand: brand,
                    // será 0 pq não se assumi juros de nada - se fosse tres sem juros seria 3 - 
                    // tenho de pensar nisto melhor pra dar a opção do logista escolher na loja e no produto quantas parcelas ele assume sem juros.
                    maxInstallmentNoInterest:0,
                    success: function(res)
                    {
                        let selectInstallments = drawSelectInstallments(res.installments[brand]);
                        document.querySelector('div.installments').innerHTML = selectInstallments;
                        console.log(res);
                    },
                    error: function(err)
                    {
                        console.log(err);
                    },
                    complete: function(res)
                    {
                        console.log(res);
                    }
                });
        }
        function drawSelectInstallments(installments) {
		let select = '<label>Opções de Parcelamento:</label>';
		select += '<select class="form-control select_installments">';
		for(let l of installments) {
		    select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
		}
		select += '</select>';
		return select;
    }
 */