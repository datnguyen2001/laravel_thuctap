
@extends('layouts.master')

@section('title')
  {{$product->title}} | Ecommerce Site

@endsection

@section('content')

<!-- start sidebar+content-->
<div class="container margin-top-20">
  <div class="row">
      <div class="col-md-6">

       <div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    @php $i=1; @endphp
     @foreach($product->images as $img)
    <div class="product-item carousel-item {{$i==1?'active':''}}">
      <img src="{{asset('images/product/'.$img->image)}}"   height="280px" alt="$product->title" width="300px" >
    </div>
    @php $i++; @endphp
   @endforeach
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>
 </div>

  <div class="mt-3">

  <p>Category <span class="badge badge-info">{{$product->category->name}} </span></p>

  <p>Brand <span class="badge badge-info">{{$product->brand->name}} </span></p>

  </div>

</div>






       <div class="col-md-6 mt-5">
        <div class="widget">
          <div class="product_show">
          <h3> {{$product->title}}</h3>
           <h3> <span class="badge badge-success"> {{number_format($product->price)}}</span> VNĐ
            <span class="badge badge-warning">{{$product->quantity < 1 ? 'No Item is Available' : $product->quantity . ' Item in stock' }} </span>
          </h3>
             <div class="product_description">
               {{$product->description}}
             </div>
        </div>
        </div>
      </div>
  </div>


  <div class="row fps" >
   <div class="col md-12">

   </div>
</div>

</div>




<!--End sidebar+content-->



@endsection

