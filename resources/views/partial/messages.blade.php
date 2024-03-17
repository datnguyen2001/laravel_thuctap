@if ($errors->any())
   <div class="container">
    <div class="row justify-content-center">
     <div class="col-md-8">
       <div class="alert alert-danger">
       <button type="button" class="close" data-dismiss="alert">&times;  </button>
        <ul>
            @foreach ($errors->all() as $error)
                <p style="text-align:center;">{{ $error }}</p>
            @endforeach
        </ul>

     </div>
   </div>
  </div>
</div>

    
@endif







@if(Session::has('success'))
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

       <div class="alert alert-success">
       <button type="button" class="close" data-dismiss="alert">&times;  </button>
 	      <p style="text-align:center;">{{Session::get('success')}}</p>

       </div>
      </div>
    </div>
 </div>

 @endif



@if(Session::has('error'))


 <div class="container">
   <div class="row justify-content-center">
    <div class="col-md-8">
     <div class="alert alert-danger">
     <button type="button" class="close" data-dismiss="alert">&times;  </button>
 	    <p style="text-align:center;">{{Session::get('error')}}</p>

    </div>
  </div>
 </div>
</div>

 @endif