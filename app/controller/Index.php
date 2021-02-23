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
        return json();
    }

    function lickWords(){
        $id = input('id');
        if (!$id){
            return;
        }
        $words = Words::find($id);
        $words -> lickCount += 1;
        $words -> save();
        return json($words);
    }

    function getOneDiary(){
        $diary =  Diary::where("flag","0")->orderRaw('rand()')->limit(1)->select();
        return json($diary[0]);
    }

    function addWords(){
        Words::create([
            'content' => input('post.words'),
            'lickCount' => '0',
            'flag' => '1'
        ]);
    }

}
