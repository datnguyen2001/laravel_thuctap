<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


  public $fillable = [

     'user_id',
     'payment_id',
     'name',
     'ip_address',
     'payment_id',
     'phone_no',
     'email',
     'shipping_address',
     'message',
     'is_paid',
     'is_completed',
     'is_seen_by_admin',
     'transaction_id',

  ];


  public function user(){

  	return $this->belongsTo(User::class);
  }


  public function cart(){

  	return $this->hasMany(Cart::class);
  }


  public function payment(){

    return $this->belongsTo(Payments::class);
  }







}
