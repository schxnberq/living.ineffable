@extends ("layouts.master")
@section("title", "Login - Apartment SETUP")
@section("content")

<div class="site__login">
	<h1 class="site__title"><span>Login</span><em>Login</em></h1>
	<form class="form" action="{{ route('auth.postLogin') }}" method="POST">
		{{ csrf_field() }}
		<div class="field">
			<label class="label" for="username">Username:</label>
			<div class="control fancy-input">
				<input class="input" type="text" name="username" id="username" placeholder="Username">
				<span class="errormsg"></span>
			</div>
		</div>
		<div class="field">
			<label class="label" for="password">Password:</label>
			<div class="control fancy-input">
				<input class="input" type="password" name="password" id="password" placeholder="password">
				<span class="errormsg"></span>
			</div>
		</div>
		<div class="field submit">
			<button type="submit" class="btn">GO!</button>
		</div>
	</form>
</div>
@endsection

