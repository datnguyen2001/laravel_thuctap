@extends('pages.user.master')

@section('sub_content')

<div class="container">

   <h2 style="text-align:center;">Chào mừng <span class="badge badge-success">{{ $user->username }}</span></h2>

   <h4 style="text-align:center;" class="mt-4"><span class="badge badge-warning">Bạn có thể thay đổi Hồ sơ của mình và các thông tin khác</span></h4>
  <div class="row">

  <div class="col-md-12 mt-5">
		  <table class="table table-border">
              <tbody>
                     <tr>
                        <td>First Name:</td>
                         <td class="text-right">{{$user->firstname}}</td>
                    </tr>

                    <tr>
                        <td>Last Name:</td>
                         <td class="text-right">{{$user->lastname}}</td>
                   </tr>
                   <tr>
                        <td>User Name:</td>
                        <td class="text-right"> {{$user->username}}</td>
                  </tr>
                  <tr>
                       <td>Phone No:</td>
                       <td class="text-right">{{$user->phoneno}}</td>
                  </tr>
                  <tr>
                     <td>email:</td>
                     <td class="text-right">{{$user->email }}</td>
                  </tr>
				  <tr>
                      <td>Street Address:</td>
                     <td class="text-right">{{$user->street_address}}</td>
                 </tr>
				<tr>
                     <td>Shipping Address:</td>
                     <td class="text-right">{{$user->shipping_address}}</td>
                  </tr>
           </tbody>
      </table>
   </div>
  </div>

   <div class="row">
  	<div style="margin-left:250px;"   class="col-md-4 mt-5">
  		<div class="card card-body  mt-2 pointer" onclick="location.href='{{route('user.profile')}}'">
  			<h3 class="btn btn-success">Update Profile</h3>
  		</div>
  	</div>

   </div>

  <div class="row fumt">

  </div>


</div>

@endsection
