<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;



Route::get('/', 'App\Http\Controllers\PageController@accueil' );
Route::get('/profile', 'App\Http\Controllers\ProfileController@profile' );

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/activitie', 'App\Http\Controllers\ActivitieController@activitie' );
Route::get('/depense', 'App\Http\Controllers\DepenseController@depense' );
Route::get('/news', 'App\Http\Controllers\newsController@news' );
Route::get('/revenue', 'App\Http\Controllers\RevenueController@revenue' );
Route::get('/subvention', 'App\Http\Controllers\SubventionController@subvention' );
Route::get('/member', 'App\Http\Controllers\MemberController@member' );


Route::post('/member', [App\Http\Controllers\MemberController::class, 'ajout']);
Route::post('/activitie', [App\Http\Controllers\ActivitieController::class, 'ajout_activitie']);
Route::post('/news', [App\Http\Controllers\NewsController::class, 'ajout_news']);
Route::post('/depense', [App\Http\Controllers\DepenseController::class, 'ajout_depense']);
Route::post('/revenue', [App\Http\Controllers\RevenueController::class, 'ajout_revenue']);
Route::post('/subvention', [App\Http\Controllers\SubventionController::class, 'ajout_subvention']);

//Edit and delete member
Route::get('/memberUpdate/{id}', 'App\Http\Controllers\MemberController@memberUpdate' );
Route::post('/editmember/{id}', 'App\Http\Controllers\MemberController@editmember' );
Route::get('/deletemember/{id}', 'App\Http\Controllers\MemberController@deletemember' );

//edit and delete news
Route::get('/newsUpdate/{id}', 'App\Http\Controllers\NewsController@newsUpdate' );
Route::post('/editnews/{id}', 'App\Http\Controllers\NewsController@editnews' );
Route::get('/deletenews/{id}', 'App\Http\Controllers\NewsController@deletenews' );

//Edit and delete activities
Route::get('/activitieUpdate/{id}', 'App\Http\Controllers\ActivitieController@activitieUpdate' );
Route::post('/editactivitie/{id}', 'App\Http\Controllers\ActivitieController@editactivitie' );
Route::get('/deleteactivitie/{id}', 'App\Http\Controllers\ActivitieController@deleteactivitie' );

//Edit ande delete spent(depense)
Route::get('/depenseUpdate/{id}', 'App\Http\Controllers\DepenseController@depenseUpdate' );
Route::post('/editdepense/{id}', 'App\Http\Controllers\DepenseController@editdepense' );
Route::get('/deletedepense/{id}', 'App\Http\Controllers\DepenseController@deletedepense' );

//Edit ande delete grant
Route::get('/subventionUpdate/{id}', 'App\Http\Controllers\SubventionController@subventionUpdate' );
Route::post('/editsubvention/{id}', 'App\Http\Controllers\SubventionController@editsubvention' );
Route::get('/deletesubvention/{id}', 'App\Http\Controllers\SubventionController@deletesubvention' );

//Edit ande delete receipts
Route::get('/revenueUpdate/{id}', 'App\Http\Controllers\RevenueController@revenueUpdate' );
Route::post('/editrevenue/{id}', 'App\Http\Controllers\RevenueController@editrevenue' );
Route::get('/deleterevenue/{id}', 'App\Http\Controllers\RevenueController@deleterevenue' );

//Edit profil
Route::post('/profile', 'App\Http\Controllers\ProfileController@profileUpdate');




