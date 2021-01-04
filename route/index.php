<?php

use think\facade\Route;

Route::group(function (){
    Route::get("/words","/index/getOneWord");
    Route::get("/diary","/index/getOneDiary");
    Route::post("/wordslick","/index/lickWords");
    Route::post("/addWords","/index/addWords");
})->allowCrossDomain();

