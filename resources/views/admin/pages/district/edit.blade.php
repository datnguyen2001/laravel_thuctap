@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Edit District
        </div>
        <div class="card-body">
          <form action="{{ route('admin.district.update',$district->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

        @include('admin.partial.messages')

            <div class="form-group">
              <label for="district_name">District Name</label>
              <input type="text" class="form-control" name="name" id="district_name"  placeholder="" value="{{$district->name}}">
            </div>


            <div class="form-group">
              <label for="quantity">Select Division</label>
              <select class="form-control" name="division_id">
                <option value="">Please Select a Division for the District</option>

               @foreach($divisions as $division)

                <option value="{{$division->id}}" {{ $district->division->id == $division->id ? 'selected' : '' }} > {{$division->name}}  </option>
  
                @endforeach
                
              </select>
            </div>
            
            


            <button type="submit" class="btn btn-success">Update District</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
