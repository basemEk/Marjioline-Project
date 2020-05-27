<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('/about-me', function () {
    return view('about-me');
});

Route::get('/programs', function () {
    return view('programs');
});

Route::get('/programs/my-training-programs', function () {
    return view('my-training-programs');
});

Route::get('/programs/individual-coaching', function () {
    return view('individual-coaching');
});

Route::get('/blogs', function () {
    return view('blogs');
});

Route::get('/contact', function () {
    return view('contact');
});


// Route::get('/testConnection', function () {
// try {
//       DB::connection()->getPdo();
//       if(DB::connection()->getDatabaseName()){
//           echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
//           die;
//       }else{
//           die("Could not find the database. Please check your configuration.");
//       }
//   } catch (\Exception $e) {
//       die($e->GetMessage());
//   }
// });
