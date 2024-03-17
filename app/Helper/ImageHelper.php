<?php

namespace App\Helper;

use App\Models\User;

use App\Helper\GravatarHelper;


/**
 *  ImageHelper
 */
class ImageHelper {

     public static function getUserImage($id){

     $user = User::find($id);
     $avatar_url="";

     if(!is_null($user)){
      
      if($user->avatar==NULL){
      	//return him gravater image

      	if(GravatarHelper::validate_gravater($user->email)){
          
          $avatar_url = GravatarHelper::gravatar_image($user->email,100);
      	}
      	else{
           //When there is no gravatar image

      		$avatar_url=url('images/default/user.png');

      	}

      }
      else{

      	// Return that image
          
          $avatar_url=url('images/user/'.$user->avatar);


      }

     }
     else{

     	//return redirect('/');
     }


   return $avatar_url;



        }


}



?>