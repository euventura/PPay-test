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
        <h2>Pagamento</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('payment.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="hidden" class="form-control" id="customer" name="customer" value="6519801">
            </div>
            <div class="form-group">
                <label for="billing_type">Tipo do pagamento</label>
                <select class="form-control" id="billing_type" name="billing_type" required>
                    <option value="">Selecione uma forma de pagamento</option>
                    <option value="BOLETO">Boleto</option>
                    <option value="PIX">PIX</option>
                    <option value="CREDIT_CARD">Credit Card</option>
                </select>
            </div>
            <div class="form-group">
                <label for="value">Valor</label>
                <input type="number" class="form-control" id="value" name="value" required>
            </div>
            <div class="form-group">
                <label for="due_date">Vencimento</label>
                <input type="date" class="form-control" id="due_date" name="due_date" required>
            </div>
            <div class="form-group">
                <label for="description">Deswcrição</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <!-- Add other fields similarly -->
            <div class="form-group  type-cc">
                <label for="credit_card_holderName">Nome no Cartão de Credito</label>
                <input type="text" class="form-control" id="credit_card_holderName" name="credit_card[holderName]">
            </div>
            <div class="form-group type-cc">
                <label for="credit_card_number">Número do cartão de crédito</label>
                <input type="text" class="form-control" id="credit_card_number" name="credit_card[number]">
            </div>
            <div class="form-group type-cc">
                <label for="credit_card_expiryMonth">Mês de expiração</label>
                <input type="text" class="form-control" id="credit_card_expiryMonth" name="credit_card[expiryMonth]" maxlength="2">
            </div>
            <div class="form-group type-cc">
                <label for="credit_card_expiryYear">Ano de Expiração</label>
                <input type="text" class="form-control" id="credit_card_expiryYear" name="credit_card[expiryYear]" maxlength="4">
            </div>
            <div class="form-group type-cc">
                <label for="credit_card_ccv">CCV</label>
                <input type="text" class="form-control" id="credit_card_ccv" name="credit_card[ccv]">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#billing_type').change(function() {
                if ($(this).val() === 'CREDIT_CARD') {
                    $('.type-cc').show();
                } else {
                    $('.type-cc').hide();
                }
            });
            $('#billing_type').trigger('change');
        });
    </script>
</body>
</html>
