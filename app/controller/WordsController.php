<?php

namespace app\controller;

use app\BaseController;
use app\facade\Utils;
use app\model\Words;
use think\facade\Cache;

class WordsController extends BaseController{

    function getOneWord(){
        $words = Words::where("flag", "0")->orderRaw('rand()')->limit(1)->select();
        $words = $words[0];
        $ip = Utils::get_real_ip();
        $words -> lickDisable = Cache::get($ip.$words -> id,false);
        return json($words);
    }

    function lickWords(){
        $id = input('id');
        if (!$id){
            return null;
        }
        $ip = Utils::get_real_ip();
        if(Cache::get($ip.$id,false)){
            return null;
        }else{
            Cache::set($ip.$id,'',10800);
        }
        $words = Words::find($id);
        $wordsLick = $words -> lick($id);
        return json($wordsLick);
    }

    function addWords(){
        $res = Utils::CheckText(input('post.words'));
        $ip = Utils::get_real_ip();
        if ($res -> conclusionType == 1){
            Words::create([
                'content'       =>  input('post.words'),
                'lickCount'     =>  '0',
                'ipaddress'     =>  $ip,
                'createdate'    =>  date("Y-m-d H:m:s"),
                'flag'          =>  '1'
            ]);
        }
        return $res;
    }

}