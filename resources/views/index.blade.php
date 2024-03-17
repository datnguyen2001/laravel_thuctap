
@extends('layouts.master')

@section('content')

<!-- start sidebar+content-->
<div class="container margin-top-20">
  <div class="row">
      <div class="col-md-4">
        <div class="list-group">
           <a href="#" class="list-group-item list-group-item-action">First item</a>
           <a href="#" class="list-group-item list-group-item-action">Second item</a>
             <a href="#" class="list-group-item list-group-item-action">Third item</a>
       </div>

      </div>

       <div class="col-md-8">
        <div class="widget">
          <h3>Feature Products</h3>
          <div class="row">
            <div class="col-md-3">
              <div class="card " style="">
               <img class="card-img-top product-image " src="{{ asset('images/'.'1.jpg')}}" alt="Card image">
                <div class="card-body">
                 <h4 class="card-title">Samsung</h4>
                   <p class="card-text">Tk-50000</p>
                    <a href="#" class="btn btn-primary">Add to Cart</a>
               </div>
            </div>
            </div>


             <div class="col-md-3">
              <div class="card" style="">
               <img class="card-img-top product-image" src="{{ asset('images/'.'3.jpg')}}" alt="Card image">
                <div class="card-body">
                 <h4 class="card-title">Realme</h4>
                   <p class="card-text">Tk-27000</p>
                    <a href="#" class="btn btn-primary">Add to Cart</a>
               </div>
            </div>
            </div>


        </div>
        
      </div>


  </div>

</div>




<!--End sidebar+content-->



@endsection

