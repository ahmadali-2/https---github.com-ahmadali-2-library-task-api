<?php

use App\Http\Controllers\Api\BookApiController;
use App\Http\Controllers\Api\RackApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post("user-register",[UserApiController::class,"register"]);
Route::post("user-login",[UserApiController::class,"login"]);
Route::get("book",[BookApiController::class,"book"]);
Route::middleware("auth:sanctum")->group(function (){

    // ADMIN actions:
    Route::post("/add-rack",[RackApiController::class,"add_rack"]);
    Route::post("/add-book",[BookApiController::class,"add_book"]);
    Route::post("/update-rack/{id}",[RackApiController::class,"update_rack"]);
    Route::post("/update-book/{id}",[BookApiController::class,"update_book"]);

    // You can delete with softDelete feature by enabling in the model.
    // I have no much time so doing straight.

    // USER actions:
    Route::get("/all-racks",[RackApiController::class,"all_racks"]);
    Route::post("/search-book/{keywords}",[BookApiController::class,"search_book"]);

});