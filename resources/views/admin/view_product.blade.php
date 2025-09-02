<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
        .div-deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }
        .table_deg
        {
            border: 2px solid greenyellow;
        }
        th
        {
            background-color: skyblue;
            color: white;
            font-size: 19px;
            font-weight: bold;
            padding: 15px;
        }
        td
        {
            border: 1px solid skyblue;
            text-align: center;
            color: white;
            padding: 12px;
        }
        input[type='search'] 
        {
           width: 500px;
            height: 60px;
            margin-left: 50px;
        }
    </style>
  </head>
  <body>
  @include('admin.header')
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <form action="{{ url('product_search') }}" method="get">
          
              <input type="Search" name="search">
              <input type="submit" class="btn btn-secondary" value="Search">
            </form>
          <div class="div_deg">
            <table class="table_deg">
                <tr>
                    <th>Product Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    
                   
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->title }}</td>
                    <td>{!! Str::limit($product->description,50)!!}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td><img src="{{ asset('product/'.$product->image) }}"
                     alt="" style="width: 100px; height: 100px;">
                    </td>

                    <td>
                   <a class="btn btn-success" href="{{ url('update_product', $product->id) }}">Edit</a>
                    </td>


                    <td>
             <a class="btn btn-danger"onclick="confirmation(event)" href="{{ route('delete_product', $product->id) }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
          
          </div>
          <div class="div-deg">
         {{ $products->onEachSide(1)->links() }}
         </div>
           </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>