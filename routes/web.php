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
    return view('welcome');
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