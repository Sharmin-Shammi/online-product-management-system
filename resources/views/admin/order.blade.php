<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
        
      table {
        text-align: center;
        border: 2px solid skyblue;
        width: 100%;
        margin: 20px 0;
        background-color: #2d3748;
        border-radius: 8px;
        overflow: hidden;
      }
      
      th {
        background-color: #3182ce;
        padding: 15px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        color: white;
        text-transform: uppercase;
      }
      
      td {
        color: #e2e8f0;
        padding: 12px;
        border-bottom: 1px solid #4a5568;
      }
      
      tr:nth-child(even) {
        background-color: #2a4365;
      }
      
      tr:hover {
        background-color: #2c5282;
      }
      
      .table_center {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
      }
      
      .btn {
        margin: 5px;
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        display: inline-block;
        transition: all 0.3s ease;
      }
      
      .btn-primary { 
        background-color: #3498db; 
      }
      
      .btn-primary:hover {
        background-color: #2c5282;
        transform: translateY(-2px);
      }
      
      .btn-success { 
        background-color: #27ae60; 
      }
      
      .btn-success:hover {
        background-color: #2f855a;
        transform: translateY(-2px);
      }

      .btn-secondary {
        background-color: #6c757d;
      }

      .btn-secondary:hover {
        background-color: #495057;
        transform: translateY(-2px);
      }
      
      img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        border: 2px solid #cbd5e0;
      }
      
      .status-in-progress {
        color: #e53e3e;
        font-weight: bold;
      }
      
      .status-on-the-way {
        color: #63b3ed;
        font-weight: bold;
      }
      
      .status-delivered {
        color: #68d391;
        font-weight: bold;
      }
      
      .empty-orders {
        text-align: center;
        color: #a0aec0;
        padding: 40px;
        font-size: 18px;
      }
      
      @media (max-width: 1200px) {
        table {
          display: block;
          overflow-x: auto;
        }
        
        th, td {
          padding: 10px 8px;
          font-size: 14px;
        }
      }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <h1 style="color: white; text-align: center; margin-bottom: 30px;">Order Management</h1>

          <div class="table_center">
            @if($data->count() > 0)
            <table>
              <tr>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Product Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Status</th>
                <th>Change Status</th>
                <th>Print PDF</th>
              </tr>
              
              @foreach ($data as $order)
              <tr>
                <td>{{ $order->name }}</td>
                <td>{{ $order->rec_address }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->product->title }}</td>
                <td>${{ number_format($order->product->price, 2) }}</td>
                <td>
                  <img src="/product/{{ $order->product->image }}" alt="{{ $order->product->title }}">
                </td>
                <td>
                  @if ($order->Status == 'in progress')
                    <span class="status-in-progress">In Progress</span>
                  @elseif($order->Status == 'On the way')
                    <span class="status-on-the-way">{{ $order->Status }}</span>
                  @elseif($order->Status == 'Delivered')
                    <span class="status-delivered">{{ $order->Status }}</span>
                  @else
                    <span style="color:yellow; font-weight: bold;">{{ $order->Status }}</span>
                  @endif
                </td>
                <td>
                  <a class="btn btn-primary" href="{{ url('on_the_way', $order->id) }}">
                    On the way
                  </a>
                  <a class="btn btn-success" href="{{ url('delivered', $order->id) }}">
                    Delivered
                  </a>
                </td>
                <td>
                  <a class="btn btn-secondary" href="{{ url('print_pdf', $order->id) }}">
                    Print PDF
                  </a>
                </td>
              </tr>
              @endforeach
            </table>
            @else
            <div class="empty-orders">
              <p>No orders found.</p>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    @include('admin.js')
  </body>
</html>
