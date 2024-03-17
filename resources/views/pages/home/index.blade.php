
@extends('layouts.master')

@section('content')

<!-- start sidebar+content-->

<!--start Slider-->

   <div class="our-slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">


              @foreach ($slider as $slider)
              <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index}}" class="{{ $loop->index == 0 ? 'active' : '' }}"></li>
              @endforeach


          </ol>
          <div class="carousel-inner">

            @foreach (App\Models\Slider::orderBy('id','desc')->get() as  $slider)

              <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                <img class="d-block w-100" src="{{ asset('images/slider/'. $slider->image) }}" alt="{{ $slider->title }}" style="height: 450px;" />

                <div class="carousel-caption d-none d-md-block">
                  <h5>{{ $slider->title }}</h5>

                  @if ($slider->button_text)
                    <p>
                      <a href="{{ $slider->button_link }}" target="_blank" class="btn btn-danger">{{ $slider->button_text }}</a>
                    </p>
                  @endif

                </div>
            </div>
            @endforeach


          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </div>


<!--EndSlider-->

<br>
<br>

<div class="container-fluid ">
  <div class="row">
      <div class="col-md-4">
        @include('partial.product_sidebar')
      </div>

       <div class="col-md-8">
        <div class="widget">

          <h3 style="text-align:center;">Tất cả sản phẩm</h3>

          <div class="row mt-4">
          @foreach($products as $product)

            <div class="col-md-3 mt-4">
              <div class="card " style="">

               @php $i=1; @endphp

               @foreach($product->images as $image)

               @if($i > 0)

                <a href="{{route('product.show',$product->slug)}}">
               <img class="card-img-top product-image" height="280px" src="{{ asset('images/product/'. $image->image)}}" alt="$product->title">
               </a>
               @endif
                @php $i--; @endphp
               @endforeach

                <div class="card-body">
                  <h4 class="card-title">
                  <a href="{{route('product.show',$product->slug)}}">{{ $product->title }}</a>
                </h4>
                   <p class="card-text">{{number_format($product->price) }} VNĐ</p>
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

</div>




<!--End sidebar+content-->



@endsection

