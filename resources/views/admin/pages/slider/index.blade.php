@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Manage Slider
        </div>
        <div class="card-body">
          
          @include('admin.partial.messages')

          <table class="table table-hover table-striped"  id="dataTable">
            <thead>
            <tr>
              <th>#</th>
              <th>Slider Name</th>
              <th>Slider Image</th>
              <th>Slider ButtonText</th>
              <th>Slide  ButtonLink</th>
              <th>Priority</th>
              <th> Action </th>
            </tr>
            </thead>
           
           <tbody>
          @foreach($slider as $slider) 
            <tr>
              <td>#</td>
              <td>{{$slider->title}} </td>
              <td>
                    <img src="{{asset('images/slider/'.$slider->image)}}" width="100">
              </td>
              <td>{{$slider->button_text}} </td>
              <td>{{$slider->button_link}} </td>
              <td>{{$slider->priority}} </td>
              
              <td>
                <a href=" {{ route('admin.slider.edit', $slider->id) }}" class="btn btn-success">Edit </a> 


                <a href="#deleteModal{{$slider->id}}" data-toggle="modal" class="btn btn-danger">Delete </a>

                <!-- Modal -->
                 <div class="modal fade" id="deleteModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                       <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                          </button>
                       </div>
                        <div class="modal-body">

                    <form action="{{route('admin.slider.delete',$slider->id)}}"  metod="POST">
                        {{ csrf_field() }}

                    <button type="submit" class="btn btn-danger">Permanent Delete</button>

                   </form>
       
       
      </div>
      <div class="modal-footer">
        
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

               </td>
          
            </tr>

            @endforeach

         </tbody>

         <tfoot> 
            <tr>
              <th>#</th>
              <th>Slider Name</th>
              <th>Slider Image</th>
              <th>Slider ButtonText</th>
              <th>Slide  ButtonLink</th>
              <th>Priority</th>
              <th> Action </th>
            </tr>
         </tfoot>

          </table>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
