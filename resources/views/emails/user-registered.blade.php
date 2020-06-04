<h1>Olá, {{ $user->name }}, tudo bem? Espero que sim</h1>

<h3>Obrigado por sua inscrição</h3>

<p>
    Aproveite bem seu tempo e faça excelentes compras em nosso marketplace!<br>
    Seu email de cadastro é: <strong>{{ $user->email }}</strong> <br>
    Sua senha: <strong>Por questão de segurança não a mostraremos aqui</strong>
</p>
<hr>
Email enviado em {{ date('d/m/Y H:i:s') }}
