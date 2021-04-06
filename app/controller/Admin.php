<?php
namespace app\controller;

use app\model\User;
use app\model\Words;

class Admin{

    function getWordsData(){
        $type = input("type");
        $wordsArray = Words::where("flag",$type) -> select();
        return json($wordsArray);
    }

    function login(){
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

}
