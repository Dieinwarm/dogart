<?php
namespace app\controller;

use app\BaseController;
use think\facade\Db;

class ApiController extends BaseController
{
    function getWords(){
        $words = Db::name('words')->where("flag","0")->orderRaw('rand()')->limit(1)->select();
        return json($words[0]);
    }

    function getDiary(){
        $diary = Db::name('diary')->where("flag","0")->orderRaw('rand()')->limit(1)->select();
        return json($diary[0]);
    }

}
