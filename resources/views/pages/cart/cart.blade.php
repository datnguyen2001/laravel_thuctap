@extends('layouts.master')

@section('content')

<div class="container">
  <div class="row mt-3">
    <div class="col-md-12">
   <h2 style="text-align:center;"> My  Cart Item </h2><br>

     @if(App\Models\Cart::total_item()>0)
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

        @foreach(App\Models\Cart::totalCart()  as $cart)
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

              <td>{{number_format($cart->product->price)}} VNĐ</td>

              <td>{{number_format($cart->product->price * $cart->product_quantity) }} VNĐ</td>

                @php $totalprice = $totalprice + $cart->product->price * $cart->product_quantity; @endphp

              <td>
                   <form class="form-inline" action="{{route('product.cart.delete',$cart->id)}}" method=" post">
              @csrf

            <input type="hidden" name="cart_id"  />
              <button type="submit" class="btn btn-danger"> Xóa </button>
            </form>
              </td>

           </tr>
           @endforeach

           <tr>
            <td colspan="4"> </td>
            <td>Total Amount</td>
            <td colspan="2"><strong>{{ number_format($totalprice) }}</strong></td>
           </tr>

      </tbody>
     </table>


     <div class="float-right mt-3">

      <a href="{{route('product')}}" class="btn btn-info btn-lg"> Continue Shopping ... </a>


       <a href="{{route('product.cart.checkout')}}" class="btn btn-warning btn-lg"> Check Out </a>

     </div>

     @else

     <div class="alert alert-warning">
      <strong>There is No Item in your Cart !!.. </strong>
     </div>

    @endif

  </div>
</div>

<div class="row fmt" >
   <div class="col md-12">

   </div>
</div>
  </div>

@endsection
