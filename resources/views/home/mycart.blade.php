<!DOCTYPE html>
<html>

<head>
  @include('home.css')
  <style type="text/css">
   .div_deg {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    margin: 50px auto;
    gap: 50px; /* Space between form and table */
    max-width: 1200px;
}

.order_deg {
    width: 350px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
    background-color: #f9f9f9;
}

.order_deg label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.order_deg input, .order_deg textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.order_deg input[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
}

.order_deg input[type="submit"]:hover {
    background-color: #0056b3;
}

table {
    border-collapse: collapse;
    width: 700px;
    text-align: center;
}

th, td {
    padding: 10px;
}

th {
    background-color: black;
    color: white;
}

td {
    border: 1px solid #ddd;
}

.cart_value {
    text-align: center;
    margin-top: 30px;
    font-size: 20px;
    font-weight: bold;
}

   

  </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->

    @include('home.header')
    <!-- end header section -->
  
  </div>


  <!-- end hero area -->
   <div class="div_deg">
   
   <div class="order_deg">

    <form action="{{ url('confirm_order') }}" method="POST">
      @csrf

    <div class="div_gap">
     
      
    <label>Receiver Name</label>
    <input type="text" name="name" value="{{ Auth::user()->name }}">



    </div>
     <div class="div_gap">
    <label>Receiver Address</label>
    <textarea name="address">{{ Auth::user()->address }}</textarea>




    </div>
     <div class="div_gap">

    <label>Receiver Phone</label>
    <input type="text" name="phone" value="{{ Auth::user()->phone }}">

    </div>
     <div class="div_gap">
      

    <input class="btn btn-primary" type="Submit" value="Place Order">



    </div>
    
    </form>


   </div>
   
   <table>

   <tr>
       
       <th>Product Title</th>
       <th> Price</th>
        <th>Image</th>
        <th>Remove</th>
 
   </tr>
   <?php
   $value=0;




   ?>


   @foreach ($cart as $cart)
   <tr>
   <td>{{ $cart->product->title }}</td>
   <td>{{ $cart->product->price }}</td>
   <td>
    <img width="150" src="/product/{{ $cart->product->Image }}">
   </td>
    <td>
   <a href="{{ url('Remove_cart/'.$cart->id) }}" class="btn btn-danger">
    Remove
  </a>
   </td>
   </tr>
 
   <?php
   $value= $value + $cart->product->price;
   ?>
   @endforeach

   </table>
   </div>
   <div class="cart_value">
    <h3>
        Total value of Cart is:${{ $value }}
    </h3>
   </div>

   

  <!-- info section -->

  @include('home.footer')
</body>

</html>