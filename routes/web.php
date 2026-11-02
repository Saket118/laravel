<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testcontroller;

Route::get('/', function () {
    return view('welcome');
});
Route:: get('/hello', function(){
return view ('hello');
});

Route:: get("/form",[testcontroller::class, "home"]);
Route:: post("register",[testcontroller::class, "register"]);
Route::get('/dashboard', [testcontroller::class, 'deshboard']);
Route::post('/logout', [testcontroller::class, 'logout']);
Route::get('/getdata', [testcontroller::class, 'getData']);
Route::get('/AddUser', [testcontroller::class, 'AddUser']);
Route:: post("/Create_user",[testcontroller::class, "newuser"]);
Route::delete('/delete-user/{id}', [testcontroller::class, 'DeleteUser']) ->name('delete.user');
