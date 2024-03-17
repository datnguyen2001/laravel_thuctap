
@extends('layouts.master')

@section('content')

<!-- start sidebar+content-->
<div class="container margin-top-20">
  <div class="row">
      <div class="col-md-4">
        @include('partial.product_sidebar')
      </div>

       <div class="col-md-8">
        <div class="widget">
          <h3 style="text-align:center;"> Tất cả sản phẩm trong <span class="badge badge-info">{{$category->name}}</span> danh mục</h3>

          @php $products = $category->product()->get(); @endphp

          @if($products->count()>0)

          <div class="row mt-4">

          @foreach($products as $product)

            <div class="col-md-3">
              <div class="card " style="">

               @php $i=1; @endphp

               @foreach($product->images as $image)

               @if($i > 0)
               <a href="{{route('product.show',$product->slug)}}">
               <img class="card-img-top product-image " src="{{ asset('images/product/'. $image-> image)}}" alt="$product->title">
               </a>
               @endif
                @php $i--; @endphp
               @endforeach

                <div class="card-body">
                  <h4 class="card-title">
                  <a href="{{route('product.show',$product->slug)}}">{{ $product->title }}</a>
                </h4>
                   <p class="card-text">{{ number_format($product->price) }}</p>
                    <a href="#" class="btn btn-primary">Thêm vào giỏ hàng</a>
               </div>
            </div>
            </div>

           @endforeach

            </div>

            @else

             <div class="alert alert-warning">
              No Product Has been yet in this Category!!!
             </div>

            @endif


        </div>

      </div>


  </div>

</div>




<!--End sidebar+content-->



@endsection
