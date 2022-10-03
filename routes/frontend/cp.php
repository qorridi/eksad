<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


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

Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'home'])->name('frontend.home');
Route::get('/about', [\App\Http\Controllers\Frontend\HomeController::class, 'about'])->name('frontend.about');
Route::get('/solutions', [\App\Http\Controllers\Frontend\HomeController::class, 'solutions'])->name('frontend.solutions');
Route::get('/portfolio', [\App\Http\Controllers\Frontend\PortfolioController::class, 'index'])->name('frontend.portfolio');
//Route::get('/portfolio_detail/{slug}', [\App\Http\Controllers\Frontend\HomeController::class, 'portfolio_detail'])->name('frontend.portfolio_detail');
Route::get('/portfolio_detail/{id}', [\App\Http\Controllers\Frontend\PortfolioController::class, 'show'])->name('frontend.portfolio_detail');
Route::get('/blogs', [\App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('frontend.blogs');
Route::get('/blog/{slug}', [\App\Http\Controllers\Frontend\BlogController::class, 'show'])->name('frontend.blog.show');
Route::get('/contact_us', [\App\Http\Controllers\Frontend\HomeController::class, 'contact_us'])->name('frontend.contact_us');
Route::post('/contact-us', [\App\Http\Controllers\Frontend\HomeController::class, 'saveContactUs'])->name('frontend.contact_us.save');
Route::post('/contact-us/submit', [\App\Http\Controllers\Frontend\HomeController::class, 'saveContactUsAjax'])->name('frontend.contact_us.save.ajax');
Route::get('/term', [\App\Http\Controllers\Frontend\HomeController::class, 'term'])->name('frontend.term');
Route::get('/privacy', [\App\Http\Controllers\Frontend\HomeController::class, 'privacy'])->name('frontend.privacy');
Route::get('/career', [\App\Http\Controllers\Frontend\JobVacancyController::class, 'index'])->name('frontend.career');
Route::get('/career_detail/{slug}', [\App\Http\Controllers\Frontend\JobVacancyController::class, 'show'])->name('frontend.career_detail');
Route::get('/career_form/{id}', [\App\Http\Controllers\Frontend\JobVacancyController::class, 'career_form'])->name('frontend.career_form');
Route::post('/career_submit', [\App\Http\Controllers\Frontend\JobVacancyController::class, 'career_submit'])->name('frontend.career_submit');

Route::post('/subscribe/save', [\App\Http\Controllers\Frontend\HomeController::class, 'saveSubscribe'])->name('frontend.subscribe.save');
