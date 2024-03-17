@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Edit Division
        </div>
        <div class="card-body">
          <form action="{{ route('admin.division.update',$division->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

        @include('admin.partial.messages')

            <div class="form-group">
              <label for="division_name">Division Name</label>
              <input type="text" class="form-control" name="name" id="division_name"  placeholder="" value="{{$division->name}}">
            </div>


            <div class="form-group">
              <label for="priority">Priority</label>
               <input type="text" class="form-control" name="priority" id="division_priority"  placeholder="" value="{{$division->priority}}">
            </div>
            
            


            <button type="submit" class="btn btn-success">Update Division</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
