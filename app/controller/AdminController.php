<?php
namespace app\controller;

use app\model\Diary;
use app\model\User;
use app\model\Words;
use think\facade\Db;

class AdminController{

    function login(){
        if (session('?login')) {
            return true;
        }
        $name = input("name");
        $password = input("password");
        $user = User::where([
            ['name','=',$name],
            ['password','=',$password]
        ]) -> select();
        if (count($user) > 0){
            session("login",$user);
            $res = session("login");
        }else{
            $res = session("login");
        }
        return json($res);
    }

    function getWordsData(){
        $type = input("type");
        $wordsArray = Words::where("flag",$type) -> select();
        return json($wordsArray);
    }

    function getDiarysData(){
        $type = input("type");
        $wordsArray = Diary::where("flag",$type) -> select();
        return json($wordsArray);
    }

    function changeWordsState(){
        $id = input("id");
        $type = input("type");
        if (!$id){
            return null;
        }
        if ($type != "yes" && $type != "no"){
            return "非法请求";
        }
        $word = Words::find($id);
        $word -> changeFlag($type);
        return json("success");
    }

    function changeDiaryState(){
        $id = input("id");
        $type = input("type");
        if (!$id){
            return null;
        }
        if ($type != "yes" && $type != "no"){
            return "非法请求";
        }
        $word = Diary::find($id);
        $word -> changeFlag($type);
        return json("success");
    }

    function getCount(){
        $wc = Db::table('words')->where('flag', '=', 1)->count();
        $dc = Db::table('diary')->where('flag', '=', 1)->count();
        $res = array(
            "wordsCount"   =>  $wc,
            "diaryCount"   =>  $dc
        );
        return json($res);
    }

}
