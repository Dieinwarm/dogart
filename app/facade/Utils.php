<?php
namespace app\facade;

use think\Facade;

class Utils extends Facade {

    protected static function getFacadeClass(){
        return "app\common\Utils";
    }

}
