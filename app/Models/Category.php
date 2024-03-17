<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

   public function parent(){

   return $this->belongsTo(Category::class,'parent_id');
   }


  public function product(){

   return $this->hasMany(Product::class);
   }








  public static function ParentOrNotCategory($parent_id,$child_id){

  	$category = Category::where('id',$child_id)->where('parent_id',$parent_id)->get();

    if(!is_null($category)){

    	return true;
    }

    else{

       return false;
    }

  }






}
