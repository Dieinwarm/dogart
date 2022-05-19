<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;

class Index extends BaseController{

    function index(){
        return View::fetch('/index');
    }

}
