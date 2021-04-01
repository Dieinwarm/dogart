<?php
namespace app\model;

use app\facade\Utils;
use think\facade\Cache;
use think\Model;

class Words extends Model{

    public function lick($id){
        $this -> lickCount += 1;
        $this -> lickDisable = true;
        $this -> save();
        return $this;
    }

}
