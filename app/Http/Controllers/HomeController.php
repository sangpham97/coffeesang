<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Blog;
use App\Models\Customer;
use App\Models\Guest;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->usertype == 1) {
             return view('admin.index');
        } else {
            return view('home');
        }

    }

    public function users() {

        $users = User::where('usertype',0)->get();

        return view('admin.Users',compact('users'));
    }

    public function deleteUser($id) {

        $user = User::find($id);

        $user->delete();

        return back();
    }

    public function updateUser(Request $request,$id) {

        $user = User::find($id);

        $user->email = $request->email;
        $user->name  = $request->name;
        // $user->password = $request->password;

        $user->save();

        return back();
    }

    public function menus() {

        $menus = Menu::orderBy('created_at','DESC')->get();

        return view('admin.Menus',compact('menus'));
    }

    public function createMenu(Request $request) {


         if(auth()->user()->usertype == 1) {

            $menu = new Menu;

            $imagePath = request('image')->store('menu','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(800,800);
            $image->save();

            $menu->title = $request->title;
            $menu->price = $request->price;
            $menu->saleprice = $request->saleprice;
            $menu->user_id = $request->user_id;
            $menu->image = $imagePath;

            $menu->save();
        }

        return back();
    }

    public function deleteMenu($id) {

        $menu = Menu::find($id);
        $menu->delete();

        return back();
    }

    public function updateMenu(Request $request,$id) {

        if(auth()->user()->usertype == 1) {

            $menu = Menu::find($id);

            $menu->title = $request->title;
            $menu->price = $request->price;
            $menu->saleprice = $request->saleprice;
            $menu->user_id = $request->user_id;

            $menu->save();
        }

        return back();

    }

    public function guests() {

        $guests = Guest::all();

        return view('admin.Guests',compact('guests'));
    }

    public function deleteGuest($id) {

        $guest = Guest::find($id);

        $guest->delete();

        return back();
    }

    public function updateGuest(Request $request,$id) {

        if(auth()->user()->usertype == 1) {
             $guest = Guest::find($id);
             $guest->name = $request->name;
             $guest->email = $request->email;
             $guest->phone = $request->phone;

             $guest->save();
        }

        return back();
    }

    public function createGuest(Request $request) {

        $guest = new Guest;

        $guest->name = $request->name;
        $guest->phone = $request->phone;
        $guest->email = $request->email;

        $guest->save();

        return back();
    }

    public function products() {

        $products = Product::orderBy('created_at',"DESC")->get();

        return view('admin.Products',compact('products'));
    }

    public function createProduct(Request $request) {

        if(auth()->user()->usertype == 1) {

            $product = new Product;

             $imagePath = request('image')->store('product','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(800,800);
            $image->save();

            $product->title = $request->title;
            $product->rating = $request->rating;
            $product->price = $request->price;
            $product->saleprice = $request->saleprice;
            $product->image = $imagePath;

            $product->save();
        }
        return back();
    }

    public function deleteProduct($id) {

        $product = Product::find($id);

        $product->delete();

        return back();
    }

    public function updateProduct(Request $request,$id) {

        if(auth()->user()->usertype == 1) {

            $product = Product::find($id);

                $product->title = $request->title;
                $product->rating = $request->rating;
                $product->price = $request->price;
                $product->saleprice = $request->saleprice;

            $product->save();
        }
        return back();
    }

    public function reviews() {

        $reviews = Review::orderBy('created_at',"DESC")->get();

        return view('admin.Reviews',compact('reviews'));
    }

    public function createReview(Request $request) {

        $review = new Review;

         $imagePath = request('image')->store('review','public');
         $image = Image::make(public_path("storage/{$imagePath}"))->fit(800,800);
         $image->save();


        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->user_name = auth()->user()->name;
        $review->user_id = auth()->user()->id;
        $review->image = $imagePath;

        $review->save();

        return back();
    }

    public function deleteReview($id) {

        $reivew = Review::find($id);

        return $reivew->delete();
    }

    public function updateReview(Request $request,$id) {

          $review = Review::find($id);

           $review->comment = $request->comment;
            $review->rating = $request->rating;

            $review->save();

            return back();
    }

    public function blogs() {

        $blogs = Blog::orderBy('created_at','DESC')->get();

        return view('admin.Blogs',compact('blogs'));
    }

    public function createBlog(Request $request) {

        if(auth()->user()->usertype == 1) {
            $blog = new Blog;

            $imagePath = request('image')->store('blog','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(800,800);
            $image->save();

            $blog->title = $request->title;
            $blog->desc = $request->desc;
            $blog->image = $imagePath;

            $blog->save();
        }

        return back();
    }

    public function deleteBlog($id) {

        $blog = Blog::find($id);

        $blog->delete();

        return back();
    }

    public function updateblog(Request $request,$id) {

        if(auth()->user()->usertype == 1) {

            $blog = Blog::find($id);

            $blog->title = $request->title;
            $blog->desc = $request->desc;

            $blog->save();
        }
        return back();
    }

    public function showMenuCart() {

        if(auth()->user()->usertype == 1) {

            $cart = DB::table('bills')
            ->join('customers','bills.customer_id','=','customers.id')
            ->join('bill_details','bills.id','=','bill_details.bill_id')
            ->join('menus','bill_details.product_id','=','menus.id')
            ->select('bills.date_order','bills.total','customers.name','bill_details.quantity','bill_details.price','menus.title','bill_details.id','bill_details.bill_id','bill_details.type')
            ->get();

              // dd($cart);

              return view('admin.MenuCart',compact('cart'));
        }

    }

    public function showProductCart() {

        if(auth()->user()->usertype == 1) {

            $cart = DB::table('bills')
            ->join('customers','bills.customer_id','=','customers.id')
            ->join('bill_details','bills.id','=','bill_details.bill_id')
            ->join('products','bill_details.product_id','=','products.id')
            ->select('bills.date_order','bills.total','customers.name','bill_details.quantity','bill_details.price','products.title','bill_details.id','bill_details.bill_id','bill_details.type')
            ->get();

              // dd($cart);

              return view('admin.ProductCart',compact('cart'));
        }

    }


    public function deleteItem($id) {

        if(auth()->user()->usertype == 1) {

            $item = BillDetail::find($id);
            $allBillId = BillDetail::where('bill_id',$item->bill_id)->get();


            if($allBillId->count() == 1) {

                $lastItem = Bill::find($item->bill_id);
                $customer = Customer::find($lastItem->customer_id);

                $lastItem->delete();
                $customer->delete();
                $item->delete();
            } else {
                $item->delete();
            }

            return back();
        }
    }
    public function updateQty(Request $request,$id) {

        if(auth()->user()->usertype == 1) {

            $item = BillDetail::find($id);
            $item->quantity = $request->quantity;

            $bill = Bill::find($item->bill_id);
            $bill->total = $request->total;

            $item->save();
            $bill->save();
        }

        return back();
    }



}
