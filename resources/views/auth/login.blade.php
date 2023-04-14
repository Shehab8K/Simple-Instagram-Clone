<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/login.css') }}">
</head>

<body>
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-6 firstContainer">
					<img src="{{ asset ('imgLogin/app-feautures.png') }}" alt="[+]" class="rounded d-block w-100">
				</div>
				<div class="col-md-6 text-center secondContainer">
					<div class="card">
						<div class="py-3 px-2">
							<img src="{{ asset ('imgLogin/instagram-logo.png') }}" alt="card-img-top">
						</div>
						<div class="card-body">
							<form method="POST" action="{{ route('login') }}">
								@csrf
								<div class="form-group py-1">
									<input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="" aria-describedby="helpId"
										placeholder="Email" value="{{ old('email') }}">
										@error('email')
                                    				<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                   				 </span>
                                			@enderror
								</div>
								<div class="form-group py-1">
									<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="" aria-describedby="helpId"
										placeholder="Password" value="{{ old('password') }}">
										@error('password')
                                    				<span class="invalid-feedback" role="alert">
                                        			<strong>{{ $message }}</strong>
                                   				 </span>
                                			@enderror
								</div>
								<input type="submit" value="Log In" class="mt-2 btn btn-primary w-100">
							</form>
							<div class="or">
								<span>OR</span>
							</div>
							<div class="otherMethods">
								<div class="secondaryColor">
									<img src="{{ asset ('imgLogin/facebook-logo.png') }}" class="img-fluid rounded" alt="[+]"
										style="width: 18px;height: 18px">
									<span class="ms-2">Login with Facebook</span>
								</div>
							</div>
							<a href="{{ route('password.request')}}"><div class="forgot-pass mt-3 primaryColor">Forgot Password ?</div></a>
						</div>
					</div>
					<div class="card my-2">
						<div class="card-body">
							<span>Don't Have an Account?</span><a href="/register"><span class="primaryColor">Sign Up</span></a>
						</div>
					</div>
					<span class="primaryColor">Get the App</span>
					<div class="row py-2">
						<div class="col-6"><img src="{{ asset ('imgLogin/playstore.png') }}" alt="[+]" class="img-fluid d-block rounded" />
						</div>
						<div class="col-6"><img src="{{ asset ('imgLogin/appstore.png') }}" alt="[+]" class="img-fluid d-block rounded" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>