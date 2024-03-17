@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Add Category
        </div>
        <div class="card-body">
          <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

        @include('admin.partial.messages')

            <div class="form-group">
              <label for="name">Category Name</label>
              <input type="text" class="form-control" name="name" id="title"  placeholder="Enter Category Name">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea name="description" rows="8" cols="80" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <label for="ParentClass">Parent Category</label>
               <select class="form-control" name="parent_id">

               <option value="">please select a parent category</option>

                 @foreach($main_categories as $category)
                   <option value="{{$category->id}}">
                    {{
                      $category->name
                   }}
                   </option>


                 @endforeach

               </select>


            </div>

             <div class="form-group">
              <label for="categorytimage">Category Image</label>
              <input type="file" class="form-control" name="categoryimage" id="categoryimage"  placeholder="Select Category image">
            </div>

            <button type="submit" class="btn btn-primary">Add Category</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
