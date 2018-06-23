<header>
	<nav class="nav">
		<div class="nav__logo">
			<h2><a href="{{ route("home") }}"><img src="/imgs/SVG/Asset 19x.svg" alt=""></a></h2>
		</div>
		@if(auth()->check())
			<ul class="nav__user">
				<li class="nav__user__item"><a class="@if(Route::is('user.index')) is-active @endif" href="{{ route('user.index') }}"><span>dashboard</span></a></li>
			</ul>
		@endif
		<ul class="nav__menu">
			<li class="nav__menu__item"><a class="@if(Route::is('home')) is-active @endif" href="{{ route("home") }}"><span>Home</span></a></li>
            @if(auth()->check())
			<li class="nav__menu__item"><a href="{{ route("auth.logout") }}"><span>Logout</span></a></li>
            @else
			<li class="nav__menu__item"><a class="@if(Route::is('auth.getLogin')) is-active @endif" href="{{ route("auth.getLogin") }}"><span>Login</span></a></li>
            @endif
		</ul>
	</nav>
	
</header>