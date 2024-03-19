<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payments;
use App\Models\Slider;
use Auth;

class PagesController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //      $slider = Slider::orderBy('id','desc')->get();                                                        //for pagination
    //      $products = Product::orderBy('id','desc')->paginate(9);  //paginate(1)
    //     return view('pages.home.index',compact('slider','products'));
    // }



     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {

        return view('pages.contact.contact');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {

         $slider = Slider::orderBy('id','desc')->get();            //for pagination
         $products = Product::orderBy('id','desc')->paginate(9);  //paginate(1)
         return view('pages.product.index',compact('slider','products'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_show($slug)
    {
        $product=Product::where('slug',$slug)->first();

        if(!is_null($product)){

           return view('pages.product.show',compact('product'));
        }

        else{
          session()->flash('error','There is no product in this list');
          return redirect()->route('product');

        }
    }




 // product sub_category controller


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function product_sub_category_show($id)
    {

       $category = Category::find($id);

       if(!is_null($category)){

        return view('pages.category.show',compact('category'));
       }

       else{
        session()->flash('error','Sorry!! There is no product in this category');

        return redirect()->route('index');
       }


    }




// product search controller



     /**
     * Show the form for searching the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_search(Request $request)
    {

      $search   = $request->search;

      $products = Product::orwhere('title','like','%'.$search.'%')->orWhere('description','like','%'.$search.'%')
          ->orWhere('slug','like','%'.$search.'%')
          ->orWhere('price','like','%'.$search.'%')
          ->orderBy('id','desc')
          ->paginate(9);


       return view('pages.product.search',compact('search','products'));


    }





  // product cart controller



  /**
     * Show the cart for  the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_cart_show()
    {

        return view('pages.cart.cart');
    }







   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function product_cart_store(Request $request)
    {

        $this->validate($request,[

        'product_id'=>'required'

        ],

        [

            'product_id.required' => 'Please Give a product id'
        ]

    );



    if(Auth::check()){

       $cart = Cart::Where('user_id', Auth::id())
                ->where('product_id',$request->product_id)
                ->where('order_id',NULL)
                ->first();
      }
      else{
         $cart = Cart::Where('ip_address',request()->ip())
                ->where('product_id',$request->product_id)
                ->where('order_id',NULL)
                ->first();

   }

    if(!is_null($cart)){

      $cart->increment('product_quantity');

      }

      else{

        $cart = new Cart;

        if(Auth::check()){

           $cart->user_id = Auth::id();
        }

        else{
            $cart->ip_address = request()->ip();
        }


        $cart->product_id = $request->product_id;
        $cart->save();

         }


    //     session()->flash('success','Product Has Added to Cart !!..');

    //    return back();

    return json_encode(['status'=> 'success','message'=>'Item Added To Cart','totaItems'=>Cart::total_item()]);

    }




 /**
     * Update the specified  cart item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_cart_update(Request $request, $id)
    {

       $cart =Cart::find($id);

       if (!is_null( $cart)) {

          $cart->product_quantity = $request->product_quantity;
          $cart->save();
       }

       else{

            return redirect()->route('product.cart.show');
       }

       session()->flash('success','Cart item has updated sucessfully !!');

       return back();
    }



    /**
     * Remove the specified cart item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_cart_delete($id)
    {

        $cart =Cart::find($id);

       if (!is_null($cart)) {

          $cart->delete();
       }

       else{

            return redirect()->route('product.cart.show');
       }

       session()->flash('success','Cart item has deleted sucessfully !!');

       return back();
    }




 //checkout controller



  /**
     * Show the cart for  the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_cart_checkout()
    {

     $payments = Payments::orderBy('priority','asc')->get();
     return view('pages.cart.checkout',compact('payments'));

    }



 /**
     * Store a cart checkout resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

 public function product_cart_checkout_store(Request $request)
    {

      $this->validate($request,[

        'name'=>'required',
        'phone_no' => 'required',
        'shipping_address' => 'required',
        'payment_method'   => 'required',

        ]);


    $order = new Order();

    //check transaction Id has given or not

//    if($request->payment_method != 'cash_in'){
//        if ($request->transaction_id==NULL || empty($request->transaction_id)) {
//
//            session()-> flash('error','Please give a  Transaction Id for your payment');
//            return back();
//        }
//    }

     $order->name = $request->name;
     $order->email = $request->email;
     $order->phone_no = $request->phone_no;
     $order->shipping_address = $request->shipping_address;
     $order->message = $request->message;
     $order->transaction_id = $request->transaction_id??1;
     $order->ip_address = request()->ip();

     if (Auth::check()) {
       $order->user_id=Auth::id();
     }

     $order->payment_id = Payments::where('short_name',$request->payment_method)->first()->id;

     $order->save();

     foreach (Cart::totalCart() as $cart) {

         $cart->order_id=$order->id;
         $cart->save();

     }


     session()->flash('success','Yor Order has taken Succesfully!!.. Please wait Admin will soon confirm it!!..');
     return redirect()->route('index');





    }



}
