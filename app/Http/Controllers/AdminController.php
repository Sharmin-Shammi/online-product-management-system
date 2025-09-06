<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Models\Category;
USE App\Models\Order;
USE App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;



class AdminController extends Controller
{
  public function view_category()
  {
    $data = Category::all();
      return view('admin.category', compact('data'));
  }
  public function add_category( Request $request)
  {
    $category = new Category;
    $category->category_name = $request->category;
    $category->save();
    toastr()->timeOut(5000)->closeButton()->addSuccess('Category Added successfully!');
    return redirect()->back();
  }
   public function edit_category($id){
    $data = Category::find($id);
    return view('admin.edit_category', compact('data'));
  }
  public function delete_category($id){
    $data = Category::find($id);
    $data->delete();
    toastr()->timeOut(5000)->closeButton()->addSuccess('Category Deleted successfully!');
    return redirect()->back();
  }
  public function update_category(Request $request, $id){
    $category = Category::find($id);
    $category->category_name = $request->category;
    $category->save();
    toastr()->timeOut(5000)->closeButton()->addSuccess('Category Updated successfully!');
    return redirect('/view_category');
  }
  public function add_product()
  {
    $categories = Category::all();
    return view('admin.add_product', compact('categories'));
  }
  public function upload_product(Request $request)
  {
    $data = new Product();
    $data->title=$request->title;
    $data->description=$request->description;
    $data->price=$request->price;
    $data->quantity=$request->quantity;
    $data->category=$request->category;
    $image=$request->image;
    if($image)
    {
      $imagename=time().'.'.$image->getClientOriginalExtension();
      $request->image->move('product', $imagename);
      $data->image=$imagename;
    }
    $data->save();
        toastr()->timeOut(5000)->closeButton()->addSuccess('Product Added successfully!');

    return redirect()->back();
  }
  public function view_product()
  {
    $products = Product::paginate(3);
    return view('admin.view_product', compact('products'));
  }
  public function delete_product($id){
    $data = Product::find($id);
   $image_path=public_path('product/'.$data->image);
   if(file_exists($image_path))
    {
       unlink($image_path);
    }
    toastr()->timeOut(5000)->closeButton()->addSuccess('Product Deleted successfully!');

    return redirect()->back();
  }
  public function update_product($id){
    $data = Product::find($id);
  $category= Category::all();
    return view('admin.update_page', compact('data', 'category'));
  }
  public function edit_product(Request $request, $id){
    $data = Product::find($id);
    $data->title=$request->title;
    $data->description=$request->description;
    $data->price=$request->price;
    $data->quantity=$request->quantity;
    $data->category=$request->category;
    $image=$request->image;
    if($image)
    {
      $imagename=time().'.'.$image->getClientOriginalExtension();
      $request->image->move('product', $imagename);
      $data->image=$imagename;
    }
    $data->save();
    toastr()->timeOut(5000)->closeButton()->addSuccess('Product Updated successfully!');
    return redirect('/view_product');
  }
  public function product_search(Request $request)
{
    $search = $request->input('search'); 

    if ($search == '') {
        // show all products if search is empty
        $products = Product::paginate(5);
    } else {
        // search in title, description, and category
        $products = Product::where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('category', 'LIKE', '%' . $search . '%')
            ->paginate(3);

        // keep search term in pagination links
        $products->appends(['search' => $search]);
    }

    return view('admin.view_product', compact('products'));
}
public function view_order()
{
  $data = Order::all();
  return view('admin.order', compact('data'));
}


public function on_the_way($id)
{
  $data = Order::find($id);
  $data->status = "On the way";
  $data->save();
  toastr()->timeOut(5000)->closeButton()->addSuccess('Order status updated to On the way!');
  return redirect('view_orders');
}
public function delivered($id)
{
  $data = Order::find($id);
  $data->status = "Delivered";
  $data->save();
  toastr()->timeOut(5000)->closeButton()->addSuccess('Order status updated to Delivered!');
  return redirect('view_orders');
}
public function print_pdf($id)
{
    $data = Order::find($id);
    $pdf = Pdf::loadView('admin.invoice', compact('data'));
    return $pdf->download('invoice.pdf');
}
}