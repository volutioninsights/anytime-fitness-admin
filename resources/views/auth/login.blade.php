@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<div class="verticalcenter">
	<a href="index.htm"><img src="/assets/img/anytime-logo-white.png" alt="Logo" class="brand" /></a>
	<div class="panel panel-primary">
		<div class="panel-body">
			<h4 class="text-center" style="margin-bottom: 25px;">Log in attempt</h4>
            <form method="POST" class="form-horizontal" action="{{ route('login') }}">
                        @csrf
					<div class="form-group">
						<label for="email" class="control-label col-sm-4" style="text-align: left;">Email</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="email" name="email">
							{{--<input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>--}}
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="control-label col-sm-4" style="text-align: left;">Password</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="password" name="password">
{{--
							<input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Password" required>
--}}
						</div>
					</div>
					<div class="clearfix">
						<div class="pull-right"><label><input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me</label></div>
					</div>
				<button type="submit" class="btn btn-primary btn-block">Log In</button>
				</form>
		</div>
		<div class="panel-footer">
			<!-- <a href="extras-forgotpassword.htm" class="pull-left btn btn-link" style="padding-left:0">Forgot password?</a>
			
			<div class="pull-right">
				<a href="#" class="btn btn-default">Reset</a>
			</div> -->
		</div>
	</div>
 </div>
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
