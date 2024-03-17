@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          View Order #LE{{$order->id}}
        </div>
        <div class="card-body">
          
          @include('admin.partial.messages')

          <h3>Order Information</h3>

         <br>

          <div class="row">
            <div class="col-md-6 border-right">
              
          <p> <strong>Orderer Name : {{$order->name}} </strong></p>
          <p> <strong>Orderer Phone No : {{$order->phone_no}} </strong></p>
          <p> <strong>Orderer Email : {{$order->email}} </strong></p>
          <p> <strong>Orderer Shipping Address : {{$order->shipping_address}} </strong></p>

            </div>

            <div class="col-md-6"> 
                <p> <strong>Order Payment Method : {{$order->payment->name}} </strong></p>
                <p> <strong>Order Payment Transaction ID : {{$order->transaction_id}} </strong></p>
            </div>
          </div>
          <hr>
          <h3>Ordered Items: </h3>

     @if($order->cart->count()>0)

     <table class="table table-bordered table-stripe">
      <thead>
        <tr>
          <th>No.</th>
          <th>Product Title</th>
          <th>Product Image</th>
          <th>Product Quantity</th>
          <th>Unit Price</th>
          <th>Sub Total Price</th>
          <th>Delete</th>
        </tr>
      </thead>

      <tbody>
        @php $totalprice=0; @endphp

        @foreach($order->cart as $cart)
            <tr>
              <td>{{$loop->index+1}}</td>
              <td>{{ $cart->product->title}}</td>
              <td>

               @php $i=1; @endphp

               @foreach($cart->product->images as $image)

               @if($i > 0) 
               <a href="{{route('product.show',$cart->product->slug)}}">
               <img class="" src="{{ asset('images/product/'. $image-> image)}}" alt="$product->title" width="80px">           
               </a>
               @endif
                @php $i--; @endphp
               @endforeach

               </td>
              <td>
                   <form class="form-inline" action="{{route('product.cart.update',$cart->id)}}" method="post">
              @csrf

            <input type="number" name="product_quantity" class="form-control" value="{{$cart->product_quantity}}" />
              <button type="submit" class="btn btn-success mt-2"> Update </button>
            </form>
              </td>

              <td>{{$cart->product->price}} Tk</td>
              
              <td>{{$cart->product->price * $cart->product_quantity }} Tk</td>
                
                @php $totalprice = $totalprice + $cart->product->price * $cart->product_quantity; @endphp
                           
              <td>
                   <form class="form-inline" action="{{route('product.cart.delete',$cart->id)}}" method=" post">
              @csrf

            <input type="hidden" name="cart_id"  />
              <button type="submit" class="btn btn-danger"> Delete </button>
            </form>
              </td>

           </tr>
           @endforeach

           <tr>
            <td colspan="4"> </td>
            <td>Total Amount</td>
            <td colspan="2"><strong>{{ $totalprice }}</strong></td>
           </tr>

      </tbody>
     </table>

     @endif

     <hr>
   

     <form action="{{route('admin.order.charge_update',$order->id)}}" method="post" style="display: inline-block!important;" >
        @csrf
        <label for="shipping_charge">Shipping Charge</label>
        <input type="text" class="form-control" name="shipping_charge" id="shipping_charge" value="{{$order->shipping_charge}}">
        <br>
        <label for="shipping_discount">Customer Discount</label>
        <input type="number" class="form-control" name="shipping_discount" id="shipping_discount" value="{{$order->shipping_discount}}">
        <br>
        <input type="submit" value="Update" class="btn btn-success">
      </form>

     <hr>

      <form action="{{route('admin.order.completed',$order->id)}}" method="post" class="form-inline" style="display: inline-block!important;" >
        @csrf

        @if($order->is_completed)
         <input type="submit" value="Cancel Order" class="btn btn-danger">
        @else
          <input type="submit" value="Complete Order" class="btn btn-success">
        @endif
      </form>


      <form action="{{route('admin.order.paid',$order->id)}}" method="post" class="form-inline"style="display: inline-block!important;">
        @csrf

        @if($order->is_paid)
        <input type="submit" value="Cancel Payment" class="btn btn-danger">
        @else
         <input type="submit" value="Paid Order" class="btn btn-success">
        @endif
      </form>
  
      <!-- For Invoice Button -->
      <a href="{{route('admin.order.invoice',$order->id)}}" class="btn btn-success"> Generate Invoice</a>
          
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
