<!DOCTYPE html>
<html>
<head>
	<title>  Southwestern University </title>
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"> Southwestern University</a>
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
		<br><br>
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<h3>Login</h3>
				<hr>
				<form method="post" action="/account/login-auth">
					@csrf
					@if(Session::has('error'))
						<div class="alert alert-info">{{Session('error')}}</div>
					@endif
					<div class="form-group">
						<label>Email Address</label>
						<input class="form-control" type="email" name="email">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input class="form-control" type="password" name="password">
					</div>
					<div class="form-group">
						<button class="btn btn-lg btn-primary">Submit</button>
						 &nbsp; <a href="/">Home</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>