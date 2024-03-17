@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Edit Product
        </div>
        <div class="card-body">
          <form action="{{ route('admin.category.update',$category->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

        @include('admin.partial.messages')

            <div class="form-group">
              <label for="category_name">Category Name</label>
              <input type="text" class="form-control" name="category_name" id="category_name"  placeholder="" value="{{$category->name}}">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea name="description" rows="8" cols="80" class="form-control">{{$category->description}}</textarea>
            </div>
            <div class="form-group">
              <label for="ParentClass">Parent Category</label>
               <select class="form-control" name="parent_id">
                <option value="">please select a parent category</option>

                  @foreach($main_category as $cat)
                   <option value="{{$cat->id}}"
                    
                   {{$cat->id == $category->parent_id ? 'selected':'' }}>{{$cat->name}}
                  
                   </option>
                   
                 @endforeach


               </select>


            </div>
            
            <div class="form-group">
              <label for="category_image">Category Old Image</label><br>

                <img src="{{asset('images/category/'.$category->image)}}" width="100">

                <br>
                <br>

              <label for="category_image">Category New Image</label>
              <input type="file" class="form-control" name="category_image" id="category_image"  placeholder="Select New Image" value="">
            </div>
            


            <button type="submit" class="btn btn-success">Update Category</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
