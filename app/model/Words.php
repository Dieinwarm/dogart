<?php
namespace app\model;

use app\facade\Utils;
use think\facade\Cache;
use think\Model;

class Words extends Model{

    public function lick(){
        $this -> lickCount += 1;
        $this -> lickDisable = true;
        $this -> save();
        return $this;
    }

    public function changeFlag($type){
        if ($type == "yes"){
            $this -> flag = 0;
        }else{
            $this -> flag = 2;
        }
        $this -> save();
    }

}
