<!DOCTYPE html>
<html>

<head>
  @include('home.css')
  <style type="text/css">
    :root {
      --primary: #007bff;
      --primary-dark: #0056b3;
      --secondary: #6c757d;
      --light: #f8f9fa;
      --dark: #343a40;
      --success: #28a745;
      --danger: #dc3545;
      --border: #dee2e6;
      --shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    body {
      background-color: #f5f7f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .cart-container {
      display: flex;
      flex-direction: column;
      max-width: 1200px;
      margin: 30px auto;
      padding: 20px;
      gap: 30px;
    }
    
    @media (min-width: 992px) {
      .cart-container {
        flex-direction: row;
        align-items: flex-start;
      }
    }
    
    .cart-items {
      flex: 1;
      background: white;
      border-radius: 12px;
      box-shadow: var(--shadow);
      overflow: hidden;
    }
    
    .order-form {
      width: 100%;
      background: white;
      border-radius: 12px;
      box-shadow: var(--shadow);
      padding: 25px;
    }
    
    @media (min-width: 992px) {
      .order-form {
        width: 380px;
      }
    }
    
    .cart-header {
      padding: 20px;
      background: var(--dark);
      color: white;
      font-size: 1.5rem;
      font-weight: 600;
    }
    
    .cart-table {
      width: 100%;
      border-collapse: collapse;
    }
    
    .cart-table th {
      text-align: left;
      padding: 16px 20px;
      background-color: #f8f9fa;
      font-weight: 600;
      color: var(--dark);
      border-bottom: 2px solid var(--border);
    }
    
    .cart-table td {
      padding: 20px;
      border-bottom: 1px solid var(--border);
      vertical-align: middle;
    }
    
    .cart-product {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    
    .cart-product img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
    }
    
    .cart-product-title {
      font-weight: 500;
      color: var(--dark);
    }
    
    .cart-price {
      font-weight: 600;
      color: var(--dark);
    }
    
    .btn-remove {
      background: var(--danger);
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 0.9rem;
      transition: all 0.2s;
    }
    
    .btn-remove:hover {
      background: #c82333;
      transform: translateY(-2px);
    }
    
    .cart-summary {
      background: var(--light);
      padding: 20px;
      border-radius: 0 0 12px 12px;
      text-align: right;
      font-size: 1.2rem;
      font-weight: 600;
    }
    
    .cart-total {
      color: var(--primary);
    }
    
    .form-title {
      font-size: 1.4rem;
      margin-bottom: 25px;
      padding-bottom: 15px;
      border-bottom: 2px solid var(--border);
      color: var(--dark);
      font-weight: 600;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: var(--dark);
    }
    
    .form-control {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.2s;
    }
    
    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(0,123,255,0.15);
    }
    
    textarea.form-control {
      min-height: 100px;
      resize: vertical;
    }
    
    .payment-options {
      display: flex;
      gap: 15px;
      margin-top: 30px;
    }
    
    .btn-payment {
      flex: 1;
      padding: 14px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      text-align: center;
      text-decoration: none;
      display: inline-block;
    }
    
    .btn-cod {
      background: var(--success);
      color: white;
    }
    
    .btn-cod:hover {
      background: #218838;
      transform: translateY(-2px);
    }
    
    .btn-card {
      background: var(--primary);
      color: white;
    }
    
    .btn-card:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
    }
    
    .empty-cart {
      text-align: center;
      padding: 40px;
      color: var(--secondary);
    }
    
    .empty-cart-icon {
      font-size: 3rem;
      margin-bottom: 15px;
      color: #dee2e6;
    }
    
    .error-message {
      background: #fff5f5;
      border: 1px solid #fed7d7;
      color: #c53030;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
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
  
  <div class="cart-container">
    <div class="cart-items">
      <div class="cart-header">
        Your Shopping Cart
      </div>
      
      <?php $value = 0; ?>
      
      @if(is_countable($cart) && count($cart) > 0)
      <table class="cart-table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cart as $cartItem)
          <tr>
            <td>
              <div class="cart-product">
                <img src="/product/{{ $cartItem->product->Image }}" alt="{{ $cartItem->product->title }}">
                <div class="cart-product-title">{{ $cartItem->product->title }}</div>
              </div>
            </td>
            <td class="cart-price">${{ $cartItem->product->price }}</td>
            <td>
              <img width="80" src="/product/{{ $cartItem->product->Image }}" alt="{{ $cartItem->product->title }}">
            </td>
            <td>
              <a href="{{ url('Remove_cart/'.$cartItem->id) }}" class="btn-remove">
                Remove
              </a>
            </td>
          </tr>
          <?php $value = $value + $cartItem->product->price; ?>
          @endforeach
        </tbody>
      </table>
      
      <div class="cart-summary">
        Total: <span class="cart-total">${{ $value }}</span>
      </div>
      
      @else
      <div class="empty-cart">
        <div class="empty-cart-icon">🛒</div>
        <h3>Your cart is empty</h3>
        <p>Add some products to see them here</p>
      </div>
      @endif
    </div>
    
    @if(is_countable($cart) && count($cart) > 0)
    <div class="order-form">
      <h2 class="form-title">Order Information</h2>
      
      <form action="{{ url('confirm_order') }}" method="POST">
        @csrf
        
        <div class="form-group">
          <label for="name">Receiver Name</label>
          <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}">
        </div>
        
        <div class="form-group">
          <label for="address">Receiver Address</label>
          <textarea id="address" name="address" class="form-control">{{ Auth::user()->address }}</textarea>
        </div>
        
        <div class="form-group">
          <label for="phone">Receiver Phone</label>
          <input type="text" id="phone" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
        </div>
        
        <div class="payment-options">
          <input type="submit" class="btn-payment btn-cod" value="Cash on Delivery">
          <a class="btn-payment btn-card" href="{{ url('stripe',$value) }}">
            Pay Using Card
          </a>
        </div>
      </form>
    </div>
    @endif
  </div>

  <!-- info section -->
  @include('home.footer')
</body>

</html>