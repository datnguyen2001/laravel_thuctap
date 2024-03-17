<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Cart extends Model
{
    


    public $fillable = [

     'user_id',
     'order_id',
     'product_id',
     'ip_address',
     'name',
     'product_quantity',


  ];


  public function user(){

    return $this->belongsTo(User::class);
  }


   public function order(){

    return $this->belongsTo(Order::class);
  }

  public function product(){

    return $this->belongsTo(Product::class);
  }





  


   /**
     * Total  Carts.
     *
     * 
     * @return  integer total_carts \Illuminate\Http\Response
     */

  public static function totalCart(){


    if(Auth::check()){

      $cart = Cart::Where('user_id', Auth::id())
                ->Where('order_id',NULL)->get();
       }

       else{
         $cart = Cart::Where('ip_address',request()->ip())->where('order_id', NULL)->get();
       }

       return $cart;

  }




/**
     * Total Item in the Cart.
     *
     * 
     * @return  integer total_item \Illuminate\Http\Response
     */

    public static function total_item(){


      // if(Auth::check()){
  
      //   $carts = Cart::Where('user_id', Auth::id())
      //             ->orWhere('ip_address',request()->ip())
      //             ->Where('order_id',NULL)
      //             ->get();
      //    }

      //    else{
  
      //      $carts = Cart::Where('ip_address',request()->ip())->Where('order_id',NULL)->get();
  
      //    }


      $carts = Cart::totalCart();
          
         $total_item=0;
  
         foreach ($carts as $cart) {
          
          $total_item =  $total_item + $cart->product_quantity;
  
         }
  
         return $total_item;
  
  
    }
  
  

}
