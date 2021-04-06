<?php

use think\facade\Route;

Route::group(function (){
    Route::post("/login","/Admin/login");
    Route::get("/words","/index/getOneWord");
    Route::get("/diary","/index/getOneDiary");
    Route::post("/wordslick","/index/lickWords");
    Route::post("/addWords","/index/addWords");
    Route::get("/datas","/index/datas");
    Route::post("/admin/getWords","/Admin/getWordsData")->middleware('checkLogin');
})->allowCrossDomain();

