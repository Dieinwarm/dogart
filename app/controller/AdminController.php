<?php
namespace app\controller;

use app\model\User;
use app\model\Words;

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

    function passVerification(){
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

}
