@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Edit Brand
        </div>
        <div class="card-body">
          <form action="{{ route('admin.brand.update',$brand->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

        @include('admin.partial.messages')

            <div class="form-group">
              <label for="brand_name">Brand Name</label>
              <input type="text" class="form-control" name="brand_name" id="brand_name"  placeholder="" value="{{$brand->name}}">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea name="description" rows="8" cols="80" class="form-control">{{$brand->description}}</textarea>
            </div>
            
            <div class="form-group">
              <label for="brand_image">Brand Old Image</label><br>

                <img src="{{asset('images/brand/'.$brand->image)}}" width="100">

                <br>
                <br>

              <label for="brand_image">Brand New Image</label>
              <input type="file" class="form-control" name="brand_image" id="brand_image"  placeholder="Select New Image" value="">
            </div>
            


            <button type="submit" class="btn btn-success">Update Brand</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
