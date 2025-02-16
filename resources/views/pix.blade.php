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
        <h2>Pix Gerado com sucesso</h2>
        <img src="data:image/jpg;base64,{{ $pixResponseJson['encodedImage'] }}">
        <div>
            <h4>Copia e Cola</h4>
            {{ $pixResponseJson['payload'] }}
        </div>
    </div>
</body>
</html>
