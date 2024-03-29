@extends('layouts.master')

@section('content')

<div class="container mt-2 mb-5">
  <div class="card card-body">
   <h2>Confirmed Item </h2>
   <hr>

  <div class="row">
  	<div class="col-md-7 border-right">
  @foreach(App\Models\Cart::totalCart()  as $cart)

   <h3>
   	{{ $cart->product->title}} - <strong>{{number_format($cart->product->price)}} VNĐ</strong>
    - <span class="badge badge-warning">{{$cart->product_quantity}} item</span>
   </h3>

  @endforeach
  	</div>

  	<div class="col-md-5">

  	@php $totalprice=0; @endphp
  	@foreach(App\Models\Cart::totalCart()  as $cart)

     @php $totalprice = $totalprice + $cart->product->price * $cart->product_quantity; @endphp

    @endforeach

      <h5>Total Price : <span class="badge badge-success">{{number_format($totalprice)}} VNĐ</span></h5>


     <h5>Total Price With Shipping Cost : <span class="badge badge-danger">{{$totalprice + App\Models\Settings::first()->shipping_cost}} VNĐ</span> </h5>

  	</div>

  </div>

   <p>
   	<a href="{{route('product.cart.show')}}" class="btn btn-success">Change Cart Item</a>
   </p>
 </div>









  <div class="card card-body mt-3">
   <h2>Shipping Address: </h2>
   <hr>

      <form method="POST" action="{{  route('product.cart.checkout.store') }}">
         @csrf

        <div class="form-group row">
         <label for="name" class="col-md-4 col-form-label text-md-right">{{ __(' Receiver Name:') }}</label>

            <div class="col-md-6">
               <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::check() ? Auth::user()->firstname .''.  Auth::user()->lastname : '' }}" required autocomplete="name" autofocus>

                 @error('name')
                   <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
           </div>
        </div>









     <div class="form-group row">
       <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address:') }}</label>

            <div class="col-md-6">
               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required autocomplete="email">

                @error('email')
               <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
               </span>
                @enderror
            </div>
         </div>


     <div class="form-group row">
       <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No:') }}</label>

         <div class="col-md-6">
          <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value=" {{ Auth::check() ? Auth::user()->phoneno : '' }} " required autocomplete="phone_no">

             @error('phone_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
             @enderror
          </div>
        </div>


       <div class="form-group row">
     <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Additional Message:') }}</label>

       <div class="col-md-6">
         <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" rows="4" >{{ Auth::check() ? Auth::user()->message : '' }} </textarea>

        @error('message')
         <span class="invalid-feedback" role="alert">
           <strong>{{ $message }}</strong>
         </span>
       @enderror
      </div>
    </div>




    <div class="form-group row">
     <label for="shipping_address" class="col-md-4 col-form-label text-md-right">{{ __('Delivery Address:') }}</label>

       <div class="col-md-6">
         <textarea id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" rows="4" >{{ Auth::check() ? Auth::user()->shipping_address : '' }} </textarea>

        @error('shipping_address')
         <span class="invalid-feedback" role="alert">
           <strong>{{ $message }}</strong>
         </span>
       @enderror
      </div>
    </div>


    <div class="form-group row ">
     <label for="payment_method" class="col-md-4 col-form-label text-md-right">{{ __('Payment Method:') }}</label>

       <div class="col-md-6">
         <select class="form-control" name="payment_method" required id="payments">
         	<option value="">Select Your Payment Method</option>
         	@foreach($payments  as $payment)
         	<option value="{{$payment->short_name}}">{{$payment->name}}
         	</option>

         	@endforeach

         </select>




         @foreach($payments  as $payment)

         @if($payment->short_name == 'cash_in')

         <div id="payment_{{$payment->short_name}}" class="hidden">

         <div class="alert alert-success mt-2">
         	<h3>For Cash in there is nothing necessary. Just click Finish order </h3>
         	<br>

         	<small>You will get your product in 2 or 3 Days</small>

         </div>

         </div>
        @else

         <div id="payment_{{$payment->short_name}}" class="hidden" >
         	<div class="alert alert-success mt-2" >
         	<h3>{{$payment->name}} Payment </h3>
         	<p>
         		<strong>{{$payment->name}} No : {{$payment->no}} </strong>
         	</p>

         	<br>

            <strong>Account Type : {{$payment->type}} </strong>

            <div class="alert alert-success mt-1">
            	Please send the avobe money to this Bkash No and write your transaction code below there..
            </div>


         	</div>
         </div>

         @endif

         @endforeach

     <input type="text" name="transaction_id" id="transaction_id"
     class="form-control hidden" placeholder="Enter transaction code">

         </div>




        @error('payment_method')
         <span class="invalid-feedback" role="alert">
           <strong>{{ $message }}</strong>
         </span>
       @enderror
      </div>

         <div class="form-group row ">
           <div class="col-md-6 offset-md-4 mb-3 mt-2">
            <button type="submit" class="btn btn-primary">
                    {{ __('Order NoW') }}
            </button>
           </div>
          </div>



    </form>
    </div>

  </div>




@endsection


@section('scripts')

<script type="text/javascript">

 $("#payments").change(function(){

 $payment_method = $("#payments").val();
 if( $payment_method =="cash_in"){

 	  $("#payment_cash_in").removeClass('hidden');
 	  $("#payment_bkash").addClass('hidden');
 	  $("#payment_rocket").addClass('hidden');
 	   $("#transaction_id").addClass('hidden');
 }

else if( $payment_method =="bkash"){

	  $("#payment_bkash").removeClass('hidden');
	  $("#payment_cash_in").addClass('hidden');
 	  $("#payment_rocket").addClass('hidden');
 	  $("#transaction_id").removeClass('hidden');

}

else if( $payment_method =="rocket"){

	  $("#payment_rocket").removeClass('hidden');
	  $("#payment_cash_in").addClass('hidden');
 	  $("#payment_bkash").addClass('hidden');
 	  $("#transaction_id").removeClass('hidden');


}



 })

  </script>



@endsection
