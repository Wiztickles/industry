<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index')->name('home');

//notice board
Route::get('notice-board', 'NewsController@index');
Route::get('notice-board/create', 'NewsController@create');
Route::post('notice-board/create', 'NewsController@store');
Route::get('notice-board/edit/{id}', 'NewsController@edit');
Route::post('notice-board/edit/{id}', 'NewsController@update');
Route::get('notice-board/delete/{id}', 'NewsController@deletePost');
Route::post('notice-board/delete/{id}', 'NewsController@delete');
//comments
Route::get('notice-board/comment/edit/{id}', 'NewsCommentsController@edit');
Route::post('notice-board/comment/edit/{id}', 'NewsCommentsController@update');
Route::get('notice-board/comment/delete/{id}', 'NewsCommentsController@deleteComment');
Route::post('notice-board/comment/delete/{id}', 'NewsCommentsController@delete');

Route::get('notice-board/{id}', 'NewsController@show');

//notice comments
Route::post('notice-board/{id}/comment', 'NewsCommentsController@store');

//archive
Route::get('archive', 'ArchiveController@index');
Route::get('archive/create', 'ArchiveController@create');
Route::post('archive/create', 'ArchiveController@store');
Route::get('archive/edit/{id}', 'ArchiveController@edit');
Route::post('archive/edit/{id}', 'ArchiveController@update');
Route::get('archive/delete/{id}', 'ArchiveController@deletePost');
Route::post('archive/delete/{id}', 'ArchiveController@delete');
//comments
Route::get('archive/comment/edit/{id}', 'ArchiveCommentsController@edit');
Route::post('archive/comment/edit/{id}', 'ArchiveCommentsController@update');
Route::get('archive/comment/delete/{id}', 'ArchiveCommentsController@deleteComment');
Route::post('archive/comment/delete/{id}', 'ArchiveCommentsController@delete');

Route::get('archive/{id}', 'ArchiveController@show');

//archive comments
Route::post('archive/{id}/comment', 'ArchiveCommentsController@store');

//project
Route::get('project', 'ProjectController@index');
Route::get('project/create', 'ProjectController@create');
Route::post('project/create', 'ProjectController@store');
Route::get('project/edit/{id}', 'ProjectController@edit');
Route::post('project/edit/{id}', 'ProjectController@update');
Route::get('project/delete/{id}', 'ProjectController@deletePost');
Route::post('project/delete/{id}', 'ProjectController@delete');
//comments
Route::get('project/comment/edit/{id}', 'ProjectCommentsController@edit');
Route::post('project/comment/edit/{id}', 'ProjectCommentsController@update');
Route::get('project/comment/delete/{id}', 'ProjectCommentsController@deleteComment');
Route::post('project/comment/delete/{id}', 'ProjectCommentsController@delete');

Route::get('project/{id}', 'ProjectController@show');

//project comments
Route::post('project/{id}/comment', 'ProjectCommentsController@store');

// user profiles
Route::get('profile', 'UserController@profileSingle');
Route::get('profile/{id}', 'UserController@profile');
Route::get('profile/{id}/project-comments', 'UserController@projectComments');
Route::get('profile/{id}/notice-board-posts', 'UserController@noticePosts');
Route::get('profile/{id}/notice-board-comments', 'UserController@noticeComments');
Route::get('profile/{id}/archive-posts', 'UserController@archivePosts');
Route::get('profile/{id}/archive-comments', 'UserController@archiveComments');
Route::get('profile/edit/{id}', 'UserController@edit');
Route::post('profile/edit/{id}', 'UserController@update');

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');
