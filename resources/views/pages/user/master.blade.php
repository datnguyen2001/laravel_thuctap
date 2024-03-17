@extends('layouts.master')

@section('content')

<div class="container mt-2">
	<div class="row">

		<div class="col-md-4">
			<div class="list-group">
				<a href="" class="laist-group-item"><img src="{{ App\Helper\ImageHelper::getUserImage(Auth::user()->id)}}"
                class="img rounded-circle" style="width: 100px">
               </a>

				<a href="{{route('user.dashboard')}}" class=" mt-3 list-group-item {{ Route::is('user.dashboard')? 'active' : ''}}">Trang điều khiển</a>
				<a href="{{route('user.profile')}}" class="list-group-item {{ Route::is('user.profile')? 'active' : ''}}">Cập nhật Profile</a>

				<a href="" class="list-group-item">Đăng xuất</a>
                <a href="" class="list-group-item"></a>

			</div>
		</div>

		<div class="col-md-8">
			<div class="card card-body">

			@yield('sub_content')

			</div>

		</div>


	</div>

 </div>

@endsection
