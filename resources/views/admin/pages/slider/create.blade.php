@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Add Slider
        </div>
        <div class="card-body">
          <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

        @include('admin.partial.messages')

            <div class="form-group">
              <label for="title">Slider Title</label>
              <input type="text" class="form-control" name="title" id="title"  placeholder="Enter Slider Title">
            </div>

            <div class="form-group">
              <label for="sliderimage">Slider Image</label>
              <input type="file" class="form-control" name="image" id="image"  placeholder="Select Slider image">
            </div>

             <div class="form-group">
              <label for="buttontext">Slider Button Text(if need)</label>
              <input type="text" class="form-control" name="button_text" id="button_text"  placeholder="Enter Slider ButtonText">
            </div>

             <div class="form-group">
              <label for="buttonlink">Slider Button Link(if need)</label>
              <input type="url" class="form-control" name="button_link" id="button_link"  placeholder="Enter Slider ButtonLink">
            </div>
            
            <div class="form-group">
              <label for="Priority">Priority</label>
              <input type="number" class="form-control" name="priority" id="priority"  placeholder="Enter Slider Priority" required>
            </div>
            
           
            
             

            <button type="submit" class="btn btn-primary">Add Slider</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
