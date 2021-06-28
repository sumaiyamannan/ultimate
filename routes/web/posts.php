<?php
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function (){
    Route::get('/posts/all', 'PostController@index')->name('post.index');
    Route::get('/posts/me', 'PostController@me')->name('post.me');
    Route::get('/posts/create', 'PostController@create')->name('post.create');
    Route::post('/posts', 'PostController@store')->name('post.store');

    Route::get('/posts/{post}/edit', 'PostController@edit')->name('post.edit');
    Route::patch('/posts/{post}/update', 'PostController@update')->name('post.update');
    Route::delete('/posts/{post}/destroy', 'PostController@destroy')->name('post.destroy');

});


?>
