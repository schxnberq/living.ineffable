<?php

use App\Lists;
use App\User;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('create:user {username} {email} {pw}', function($username, $email, $pw) {
	User::create([
		'username' => $username,
		'email' => $email,
		'password' => bcrypt($pw)
	]);
});

Artisan::command('create:list {name} {items} {img} {shared_with}', function($name, $items, $img, $shared_with) {
	Lists::create([
		'name' => $name,
		'items' => $items,
		'img' => $img,
		'shared_with' => $shared_with
	]);
});
