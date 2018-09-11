<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/register', 'Api\UserController@register');
Route::post('auth/login', 'Api\UserController@login');
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user', 'Api\UserController@getAuthUser');
});

Route::middleware('jwt.auth')->prefix('cursos')->group(function () {
    Route::get('', ['uses' => 'Api\CourseController@allCourses']);
    Route::get('{id}', ['uses' => 'Api\CourseController@getCourse']);
    Route::post('', ['uses' => 'Api\CourseController@saveCourse']);
    Route::put('{id}', ['uses' => 'Api\CourseController@updateCourse']);
    Route::delete('{id}', ['uses' => 'Api\CourseController@deleteCourse']);
    Route::delete('{course_id}/{category_id}', ['uses' => 'Api\CourseController@deleteCouseCategory']);
});


Route::middleware('jwt.auth')->prefix('categorias')->group(function () {
    Route::get('', ['uses' => 'Api\CategoryController@allCategories']);
    Route::get('{id}', ['uses' => 'Api\CategoryController@getCategory']);
    Route::post('', ['uses' => 'Api\CategoryController@saveCategory']);
    Route::put('{id}', ['uses' => 'Api\CategoryController@updateCategory']);
    Route::delete('{id}', ['uses' => 'Api\CategoryController@deleteCategory']);
});