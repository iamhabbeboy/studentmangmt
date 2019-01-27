<!DOCTYPE html>
<html>
<head>
	<title> Dashboard :: Southwestern University</title>
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
	    <script src="{{ asset('js/jquery.js') }}" defer></script>
	<style>
	@media print
{
.noprint {display:none;}
}

@media screen
{

}
</style>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Southwestern University</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>

<br><br>
	<div class="container">
		{{-- {{dd(session('student_data'))}} --}}

		<br><br>
		<div class="row">
			<div class="col-md-3 noprint">
				<div class="list-group">
					<div class="list-group-item">
				@if (array_get($studentInfo, 'photo'))
					<img src="{{ array_get($studentInfo, 'photo') }}" style="width: 100px;max-width: 100%;">
					<br><br>
					<b>Welcome back, {{array_get(session('student_data'), 'name')}} </b>
				@endif
			</div>
					<a class="list-group-item" href="/account/dashboard">Home</a>
					{{-- @if ($student_info == ) --}}
					{{-- @endif --}}
					@if (array_get($student_info, 'data') != "")
						<a class="list-group-item" href="?p=history">Print Payment </a>
						<a class="list-group-item" href="?p=courses">Course Registration</a>
						<a class="list-group-item" href="?p=registered">Course Registered</a>
					@else
						<a class="list-group-item" href="?p=payment">Make Payment</a>
					@endif
					<a class="list-group-item" href="/account/logout">Logout</a>
				</div>
			</div>
			<div class="col-md-9">
				@if(array_get($_GET, 'p') == 'payment')
					@include('student.payment')
				@elseif(array_get($_GET, 'p') == 'course')
					@include('student.course')
				@elseif(array_get($_GET, 'p') == 'history')
					@include('student.history')
				@elseif(array_get($_GET, 'p') == 'courses')
					@include('student.course')
				@elseif(array_get($_GET, 'p') == 'registered')
					@include('student.registered')
				@else
				<h3>Dashboard</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				@endif
			</div>
		</div>
	</div>
</body>
</html>