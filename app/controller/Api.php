<?php
namespace app\controller;

use app\BaseController;
use app\model\Words;
use think\facade\Db;

class Api extends BaseController
{
    function getWords(){
        $words = Db::name('words')->where("flag","0")->orderRaw('rand()')->limit(1)->select();
        return json($words[0]);
    }

}