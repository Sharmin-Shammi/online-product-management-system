<!doctype html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container">
        <center>
        <h3>Customer name:{{ $data->name }}</h3>
        <h3>Customer address: {{ $data->address }}</h3>
        <h3> phone: {{ $data->phone }}</h3>
        <h2>Product title: {{ $data->product_title }}</h2>
        <h2>Product price: {{ $data->product_price }}</h2>
        </center>
       
    </div>
</body>
</html>