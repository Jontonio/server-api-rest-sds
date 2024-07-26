<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\ExistUser;
use App\Http\Middleware\JwtMiddleware;
Route::middleware([JwtMiddleware::class])->group(function(){

//Endpoint user
//Route::get('get-users',[AuthController::class,'getUsers']);
    //->middleware(['role:admin']);

//Route::get('get-roles',[AuthController::class,'getRoles'])
 //   ->middleware(['role:admin']);

//Route::get('get-permissions',[AuthController::class,'getPermissions'])
 //   ->middleware(['role:admin']);

//Route::post('register-user',[AuthController::class,'register'])
 //   ->middleware(['role:root|admin']);

//Route::post('assign-user-role/{id}',[AuthController::class,'assignUserRole'])
  //  ->middleware(['role:root|admin', ExistUser::class]);

//Route::get('user-authenticated', [AuthController::class,'userAuthenticated']);
//Route::get('logout', [AuthController::class,'logout']);


//Route::post('login', [AuthController::class,'login']);
//Route::post('refresh', [AuthController::class,'refresh']);



});