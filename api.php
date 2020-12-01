<?php

use Illuminate\Support\Facades\Route; //For defining routs
use App\Http\Controllers\APIController;//Registring controller for using it within this file
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/


Route::POST('/register',[APIController::class,'Register']);

Route::POST('/login',[APIController::class,'login']);


Route::GET('/list',[APIController::class,'list']);