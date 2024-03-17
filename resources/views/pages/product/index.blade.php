
@extends('layouts.master')

@section('content')

<!-- start sidebar+content-->
<div class="container-fluid margin-top-20">
  <div class="row">
      <div class="col-md-4">
        @include('partial.product_sidebar')
      </div>

       <div class="col-md-8">
        <div class="widget">
          <h3 style="text-align:center;"> Products</h3>

          <div class="row mt-4">
          @foreach($products as $product)

            <div class="col-md-3 mt-4">
              <div class="card ">

               @php $i=1; @endphp

               @foreach($product->images as $image)

               @if($i > 0)
               <a href="{{route('product.show',$product->slug)}}">
               <img class="card-img-top product-image " height="280px"  src="{{ asset('images/product/'. $image-> image)}}" alt="$product->title">
               </a>
               @endif
                @php $i--; @endphp
               @endforeach

                <div class="card-body">
                  <h4 class="card-title">
                  <a href="{{route('product.show',$product->slug)}}">{{ $product->title }}</a>
                </h4>
                   <p class="card-text">{{ number_format($product->price) }} VNĐ</p>

                    @include('pages.product.partial.cart_button')

               </div>
            </div>
            </div>


           @endforeach

            </div>


          <!--pagination -->

            <div class="pagination mt-5">
              {{$products->links()}}
            </div>


        </div>
      </div>
  </div>

  <div class="row fmtp" >
   <div class="col md-12">

   </div>
</div>

</div>




<!--End sidebar+content-->



@endsection

