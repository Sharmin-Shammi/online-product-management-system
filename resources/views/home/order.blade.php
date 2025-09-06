<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        @include('home.css')
        <style type="text/css">
            .div_center {
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 60px;
            }
            table, th, td {
                border: 2px solid black;
                border-collapse: collapse;
                padding: 10px;
                text-align: center;
                width: 800px;
                font-weight: bold;
            }
        </style>

    </head>
    <body>
        <div class="hero_area">
    <!-- header section strats -->

    @include('home.header')

    <div class="div_center">

    <table>

    <tr>

    <th>Product Name</th>
    <th>Price</th>
    <th>Delivery Status</th>
    <th>Image</th>
    </tr>

    @foreach($order as $order)
    <tr>
        <td>{{ $order->product->title }}</td>
        <td>{{ $order->product->price }}</td>
        <td>{{ $order->status }}</td>
        <td>
            <img height="200" width="300"src="product/{{ $order->product->image }}" >
        </td>
    </tr>
    @endforeach
    </table>
    </div>
    </div>

      @include('home.footer')
    </body>
</html>


