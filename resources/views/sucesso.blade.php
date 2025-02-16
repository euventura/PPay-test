<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-5">
        @if ($paymentResponse['billingType'] == 'BOLETO')
        <h2>Pedido feito com sucesso aguardando pagamento do boleto</h2>
        <div>
            <h4>Link para gerar o boleto</h4>
            <a href="{{ $paymentResponse['bankSlipUrl'] }}">Clique aqui apra gerar o boleto</a>
        </div>
        @else
        <h2>Pago com sucesso</h2>
        @endif


    </div>
</body>
</html>
