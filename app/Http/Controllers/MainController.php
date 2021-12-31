<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Blog;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Review;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {

        $menus = Menu::orderBy('created_at','DESC')->get();
        $products = Product::orderBy('created_at','DESC')->get();
        $blogs = Blog::orderBy('created_at','DESC')->get();
        $reviews = Review::orderBy('created_at','DESC')->get();
        $cart = Cart::content();
        $totalPrice = Cart::subtotal();
        // dd($cart);

        return view('main',compact('menus','products','blogs','reviews','cart','totalPrice'));
    }

    public function singleBlog($id) {

        $blog = Blog::find($id);

        return view('singleblog.blog',compact('blog'));
    }

    public function addCart($id) {

        if(auth()->user()) {

            $menu = Menu::find($id);
            Cart::add(['id' => $menu->id,'name' => $menu->title,'qty' => 1,'price' => $menu->price,'weight' => 1,'options' => ['image' => $menu->image,'username' => auth()->user()->name,'type' => 1]]);

            return back();
        } else {

            return back();
        }

    }

   public function removeCart($rowId) {

        if(auth()->user()) {
            Cart::remove($rowId);

            return back();
        }
   }

    public function addCartProduct($id) {

        if(auth()->user()) {

            $product = Product::find($id);
            Cart::add(['id' => $product->id,'name' => $product->title,'qty' => 1,'price' => $product->price,'weight' => 1,'options' => ['image' => $product->image,'username' => auth()->user()->name,'type' => 2]]);

            return back();
        } else {

            return back();
        }

    }

    public function saveCart(Request $request) {

        if(auth()->user()) {

            $cartInfor = Cart::content();

            try {
            // save
            $customer = new Customer;
            $customer->name = auth()->user()->name;
            $customer->email = auth()->user()->email;
            $customer->save();

            $bill = new Bill;
            $bill->customer_id = $customer->id;
            $bill->date_order = date('Y-m-d H:i:s');
            $bill->total = str_replace(',', '', Cart::subtotal());
            $bill->save();

            if ($cartInfor->count() > 0) {
                foreach ($cartInfor as $key => $item) {
                    $billDetail = new BillDetail;
                    $billDetail->bill_id = $bill->id;
                    $billDetail->product_id = $item->id;
                    $billDetail->quantity = $item->qty;
                    $billDetail->price = $item->price;
                    $billDetail->type = $item->options->type;
                    $billDetail->save();
                }
            }
          // del
           Cart::destroy();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    return redirect('/');
}
}
