<?php

namespace app\controller;

use app\BaseController;
use app\facade\Utils;
use app\model\Diary;

class DiaryController extends BaseController {

    function getOneDiary(){
        $diary =  Diary::where("flag","0")->orderRaw('rand()')->limit(1)->select();
        return json($diary[0]);
    }

    function addDiary(){
        $res = Utils::CheckText(input('post.diary'));
        $ip = Utils::get_real_ip();
        if ($res -> conclusionType == 1){
            Diary::create([
                'content'       =>  input('post.diary'),
                'lickCount'     =>  '0',
                'ipaddress'     =>  $ip,
                'createdate'    =>  date("Y-m-d H:m:s"),
                'flag'          =>  '1'
            ]);
        }
        return $res;
    }

}