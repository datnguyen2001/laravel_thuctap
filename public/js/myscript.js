
// function addTocart(product_id){

// 	  $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });


// $.post( "http://127.0.0.1:8000/api/product/cart/store",

//  {

//   product_id: product_id 

//   })


//   .done(function( data ) {
    
//     data =JSON.parse(data);
//     if(data.status=='success'){
    	
//     	//toast

//     	 alertify.set('notifier','position', 'top-center');
//          alertify.success('Item Added to Cart Succesfully');
          
//           $("#total_item").html(data.totaItems);
//     }

//   });

// }




function addTocart(product_id){

  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $.ajax({
        url: '/product/cart/store',
        type:'POST',
        dataType:'JSON',
        data:{product_id: product_id },

        success:function(data){
    	
    	//toast

    	   alertify.set('notifier','position', 'top-center');
         alertify.success('Item Added to Cart Succesfully');
          
          $("#total_item").html(data.totaItems);
                
        }
    });

    }