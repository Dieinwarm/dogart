<?php
namespace app\controller;

use app\BaseController;
use app\facade\Utils;
use app\model\Diary;
use app\model\Words;
use think\facade\Cache;
use think\facade\View;

class Index extends BaseController{

    function index(){
        return View::fetch('index');
    }

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
            return;
        }
        $ip = Utils::get_real_ip();
        if(Cache::get($ip.$id,false)){
            return;
        }else{
            Cache::set($ip.$id,'',10800);
        }
        $words = Words::find($id);
        $wordsLick = $words -> lick($id);
        return json($wordsLick);
    }

    function getOneDiary(){
        $diary =  Diary::where("flag","0")->orderRaw('rand()')->limit(1)->select();
        return json($diary[0]);
    }

    function addWords(){
        $res = Utils::CheckText(input('post.words'));
        if ($res -> conclusionType == 1){
            Words::create([
                'content' => input('post.words'),
                'lickCount' => '0',
                'flag' => '1'
            ]);
        }
        return $res;
    }

}
