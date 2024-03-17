@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Manage Division
        </div>
        <div class="card-body">
          
          @include('admin.partial.messages')

          <table class="table table-hover table-striped"  id="dataTable">
            <thead>
            <tr>
              <th>#</th>
              <th>Division Name</th>
              <th>Priority</th>
              <th> Action </th>
            </tr>
            </thead>
           
           <tbody>
          @foreach($division as $division) 
            <tr>
              <td>#</td>
              <td>{{$division->name}} </td>

              <td>{{$division->priority}} </td>
              
              <td>
                <a href=" {{ route('admin.division.edit', $division->id) }}" class="btn btn-success">Edit </a> 


                <a href="#deleteModal{{$division->id}}" data-toggle="modal" class="btn btn-danger">Delete </a>

                  <!-- Modal -->
                   <div class="modal fade" id="deleteModal{{$division->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                         <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                            </button>
                         </div>
                          <div class="modal-body">

                              <form action="{{route('admin.division.delete',$division->id)}}"  metod="POST">
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
              <th>Division Name</th>
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
