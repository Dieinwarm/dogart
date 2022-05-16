<?php

use think\facade\Route;

Route::group(function (){
    Route::post("/login","/Admin/login");
    Route::get("/words","/index/getOneWord");
    Route::get("/diary","/index/getOneDiary");
    Route::post("/wordslick","/index/lickWords");
    Route::post("/addWords","/index/addWords");
    Route::get("/datas","/index/datas");
})->allowCrossDomain();

Route::group(function (){
    Route::get("/admin/getWords","/Admin/getWordsData");
    Route::post("/admin/changeState","/Admin/passVerification");
})->allowCrossDomain()->middleware('checkLogin');
//})->allowCrossDomain();

