<?php

use think\facade\Route;

Route::group(function (){
    Route::post("/words","/index/getOneWord");
    Route::post("/diary","/index/getOneDiary");
    Route::post("/wordslick","/index/lickWords");
})->allowCrossDomain();

