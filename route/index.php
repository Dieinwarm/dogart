<?php

use think\facade\Route;

Route::group(function (){
    Route::post("/login","/AdminController/login");
    Route::get("/words","/WordsController/getOneWord");
    Route::post("/wordslick","/WordsController/lickWords");
    Route::post("/addWords","/WordsController/addWords");
    Route::get("/diary","/DiaryController/getOneDiary");
    Route::post("/addDiary","/DiaryController/addDiary");
})->allowCrossDomain();

Route::group(function (){
    Route::get("/admin/getWords","/AdminController/getWordsData");
    Route::get("/admin/getDiarys","/AdminController/getDiarysData");
    Route::post("/admin/changeWordsState","/AdminController/changeWordsState");
    Route::post("/admin/changeDiaryState","/AdminController/changeDiaryState");
    Route::get("/admin/getCount","/AdminController/getCount");
})->allowCrossDomain()->middleware('checkLogin');
//})->allowCrossDomain();

