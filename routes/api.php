<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DoctorController;
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
Route::post('/login', [LoginController::class, 'login']);

//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function(){

      //user
      Route::get('/user', [LoginController::class, 'user']);
      Route::post('/logout', [LoginController::class, 'logout']);

      //doctor para realizar consulta
      Route::get('/doctores', [DoctorController::class, 'index']); //all doctor for consult
      Route::post('/doctorc/{id}/consulta', [DoctorController::class, 'crearConsulta']); //crear consulta a un doctor
});
