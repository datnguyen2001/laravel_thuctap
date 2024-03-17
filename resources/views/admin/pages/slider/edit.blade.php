@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Edit Slider
        </div>
        <div class="card-body">
          <form action="{{ route('admin.slider.update',$slider->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

        @include('admin.partial.messages')

             
            <div class="form-group">
              <label for="title">Slider Title</label>
              <input type="text" class="form-control" name="title" id="title" value="{{$slider->title}}">
            </div>

            <div class="form-group">
               <label for="brand_image">Slider Old Image</label><br>

                <img src="{{asset('images/slider/'.$slider->image)}}" width="100">

                <br>
                <br>

              <label for="brand_image">Slider New Image</label>
              <input type="file" class="form-control" name="image" id="image"  placeholder="Select Slider image">
            </div>

             <div class="form-group">
              <label for="buttontext">Slider Button Text</label>
              <input type="text" class="form-control" name="button_text" id="buttontext" value="{{$slider->button_text}}">
            </div>

             <div class="form-group">
              <label for="buttonlink">Slider Button Link</label>
              <input type="text" class="form-control" name="button_link" id="buttonlink"  value="{{$slider->button_link}}">
            </div>
            
            <div class="form-group">
              <label for="Priority">Priority</label>
              <input type="text" class="form-control" name="priority" id="priority" value="{{$slider->priority}}">
            </div>
            
            
            


            <button type="submit" class="btn btn-success">Update Slider</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
