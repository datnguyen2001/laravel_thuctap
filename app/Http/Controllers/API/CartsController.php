<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;

class CartsController extends Controller
{
    


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

    return json_encode(['status'=> 'success','message'=>'Item Added To Cart','totaItems'=>Cart::total_item()]);

    }



   
}
