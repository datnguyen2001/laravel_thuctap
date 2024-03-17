   <div class="list-group mt-4">

	@foreach(App\Models\Category::orderBy('name','asc')->where('parent_id',NULL)->get() as $pa_category)

      <a href="#main-{{$pa_category->id}}" class="list-group-item list-group-item-action" data-toggle="collapse"><img src="{{asset('images/category/'.$pa_category->image)}}" width="50px">
           	{{$pa_category->name}}</a>


      <div class=" collapse

        @if(Route::is('product.sub_category.show'))
        @if(App\Models\Category::ParentOrNotCategory($pa_category->id,$category->id))
          show
        @endif
        @endif


       child-rows" id="main-{{$pa_category->id}}">


      @foreach(App\Models\Category::orderBy('name','asc')->where('parent_id',$pa_category->id)->get() as $sub_category)

       <a href="{{route('product.sub_category.show',$sub_category->id)}}" class="list-group-item list-group-item-action

        @if(Route::is('product.sub_category.show'))
        @if($sub_category->id== $category->id)
          active
        @endif
        @endif


        ">


        <img src="{{asset('images/category/'.$sub_category->image)}}" width="40px">

           	{{$sub_category->name}}    </a>

       @endforeach



      </div>

     @endforeach

 </div>
