<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; // Thêm dòng này
use App\Http\Controllers\CategoryCourse;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\DoanVanController;
use App\Http\Controllers\CauHoiDController;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



//backend

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);




//category course

Route::get('/add-category-course', [CategoryCourse::class, 'add_category_course']);
Route::get('/all-category-course', [CategoryCourse::class, 'all_category_course']);
Route::post('/save-category-course', [CategoryCourse::class, 'save_category_course']);
Route::get('/edit-category-course/{category_course_id}', [CategoryCourse::class, 'edit_category_course']);
Route::get('/delete-category-course/{category_course_id}', [CategoryCourse::class, 'delete_category_course']);
Route::post('/update-category-course/{category_course_id}', [CategoryCourse::class, 'update_category_course']);



// user 

Route::get('/add-user', [UsersController::class, 'add_user']);
Route::get('/all-user', [UsersController::class, 'all_user']);
Route::post('/save-user', [UsersController::class, 'save_user']);
Route::get('/edit-user/{user_id}', [UsersController::class, 'edit_user']);
Route::get('/delete-user/{user_id}', [UsersController::class, 'delete_user']);
Route::post('/update-user/{user_id}', [UsersController::class, 'update_user']);


// lesson - bai hoc
Route::get('/add-lesson', [LessonController::class, 'add_lesson']);
Route::get('/all-lesson', [LessonController::class, 'all_lesson']);
Route::post('/save-lesson', [LessonController::class, 'save_lesson']);
Route::get('/edit-lesson/{lesson_id}', [LessonController::class, 'edit_lesson']);
Route::get('/delete-lesson/{lesson_id}', [LessonController::class, 'delete_lesson']);
Route::post('/update-lesson/{lesson_id}', [LessonController::class, 'update_lesson']);



// document - tai lieu
Route::get('/add-document', [DocumentController::class, 'add_document']);
Route::get('/all-document', [DocumentController::class, 'all_document']);
Route::post('/save-document', [DocumentController::class, 'save_document']);
Route::get('/edit-document/{user_id}', [DocumentController::class, 'edit_document']);
Route::get('/delete-document/{user_id}', [DocumentController::class, 'delete_document']);
Route::post('/update-document/{user_id}', [DocumentController::class, 'update_document']);
Route::get('/view-document/{id}', [DocumentController::class, 'view_document']);


//test

Route::get('/add-test', [TestController::class, 'add_test']);
Route::get('/all-test', [TestController::class, 'all_test']);
Route::post('/save-test', [TestController::class, 'save_test']);
Route::get('/edit-test/{test_id}', [TestController::class, 'edit_test']);
Route::get('/delete-test/{test_id}', [TestController::class, 'delete_test']);
Route::post('/update-test/{test_id}', [TestController::class, 'update_test']);


// audio 
Route::get('/add-audio', [AudioController::class, 'add_audio']);
Route::get('/all-audio', [AudioController::class, 'all_audio']);
Route::post('/save-audio', [AudioController::class, 'save_audio']);
Route::get('/edit-audio/{user_id}', [AudioController::class, 'edit_audio']);
Route::get('/delete-audio/{user_id}', [AudioController::class, 'delete_audio']);
Route::post('/update-audio/{user_id}', [AudioController::class, 'update_audio']);
Route::get('/view-audio/{id}', [AudioController::class, 'view_audio']);


// doanvan
Route::get('/add-doanvan', [DoanVanController::class, 'add_doanvan']);
Route::get('/all-doanvan', [DoanVanController::class, 'all_doanvan']);
Route::post('/save-doanvan', [DoanVanController::class, 'save_doanvan']);
Route::get('/edit-doanvan/{user_id}', [DoanVanController::class, 'edit_doanvan']);
Route::get('/delete-doanvan/{user_id}', [DoanVanController::class, 'delete_doanvan']);
Route::post('/update-doanvan/{user_id}', [DoanVanController::class, 'update_doanvan']);
Route::get('/view-doanvan/{id}', [DoanVanController::class, 'view_audio']);


// cauhoi
Route::get('/add-cauhoi', [CauHoiDController::class, 'add_cauhoi']);
Route::get('/all-cauhoi', [CauHoiDController::class, 'all_cauhoi']);
Route::post('/save-cauhoi', [CauHoiDController::class, 'save_cauhoi']);
Route::get('/edit-cauhoi/{user_id}', [CauHoiDController::class, 'edit_cauhoi']);
Route::get('/delete-cauhoi/{user_id}', [CauHoiDController::class, 'delete_cauhoi']);
Route::post('/update-cauhoi/{user_id}', [CauHoiDController::class, 'update_cauhoi']);
Route::get('/view-cauhoi/{id}', [CauHoiDController::class, 'view_audio']);
