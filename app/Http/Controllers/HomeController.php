<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Stripe;
use Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('usertype', 'user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all('status')->count();
        $delivered = Order::where('status', 'delivered')->get()->count();
        return view('admin.index', compact('user', 'product', 'order', 'delivered'));
    }
    public function home()
    {
        $products = Product::all();
        if(Auth::id())
        {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
        }
        else
            {
                $count = '';
            }
        return view('home.index', compact('products', 'count'));
    }
    public function login_home()
    {
        $products = Product::all();
        if(Auth::id())
        {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
        }
        else
            {
                $count = '';
            }
        return view('home.index', compact('products', 'count'));
    }
    public function product_details($id)
    {
        $data=Product::find($id);
         if(Auth::id())
        {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
        }
        else
            {
                $count = '';
            }
        return view('home.product_details', compact('data', 'count'));
}
       public function add_to_cart( $id)
{
    
        $product_id=$id;
        $user=Auth::user();
        $user_id=$user->id;
        $data=new Cart;
        $data->user_id=$user_id;
        $data->product_id=$product_id;
        $data->save();
            toastr()->timeOut(5000)->closeButton()->addSuccess('Product Added to Cart successfully!');

        return redirect('login');
    }
    public function mycart()
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
            $cart = Cart::where('user_id', $user_id)->get();
        }
          
        return view('home.mycart', compact('count','cart'));
    }
   public function delete_cart($id)
{
    Cart::findOrFail($id)->delete();

    toastr()->timeOut(5000)->closeButton()->addSuccess('Product Removed from Cart successfully!');

    return redirect()->back();
}
public function confirm_order(Request $request)
{
    // Get authenticated user object (not just ID)
    $user = Auth::user();
    
    $name = $request->name;
    $address = $request->address;
    $phone = $request->phone;
    
    // Get user's cart items
    $cart = Cart::where('user_id', $user->id)->get();
    
    // Check if cart is empty
    if($cart->isEmpty()) {
        toastr()->error('Your cart is empty!');
        return redirect()->back();
    }
    
    // Create orders for each cart item
    foreach($cart as $cartItem)
    {
        $order = new Order;
        $order->name = $name;
        $order->rec_address = $address;
        $order->phone = $phone;
        $order->user_id = $user->id; // Use $user->id (integer)
        $order->product_id = $cartItem->product_id;
        $order->save();
    }
    
    // FIX: Actually DELETE all cart items for this user
    Cart::where('user_id', $user->id)->delete();
    
    toastr()->timeOut(5000)->closeButton()->addSuccess('Order Confirmed Successfully!');
    return redirect()->back();
}
public function myorders()

{
    $user = Auth::user()->id;
    $count=Cart::where('user_id', $user)->get()->count();
    $order=Order::where('user_id', $user)->get();
    return view('home.order', compact('user', 'count', 'order'));
}
 public function stripe($value)

    {

        return view('home.stripe', compact('value'));
    }
public function stripePost(Request $request,$value)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => $value * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment completed" 

        ]);

        Session::flash('success', 'Payment successful!');
        return back();

    }
}



