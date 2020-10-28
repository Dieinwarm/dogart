<?php
namespace app\controller;

use app\BaseController;
use app\model\Diary;
use app\model\Words;
use think\facade\View;

class Index extends BaseController
{
    function index(){
        return View::fetch('index');
    }

    function getOneWord(){
        $words =  Words::where("flag","0")->orderRaw('rand()')->limit(1)->select();
        return json($words[0]);
    }

    function getOneDiary(){
        $diary =  Diary::where("flag","0")->orderRaw('rand()')->limit(1)->select();
        return json($diary[0]);
    }
}
