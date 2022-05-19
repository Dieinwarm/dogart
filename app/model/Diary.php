<?php
namespace app\model;


use think\Model;

class Diary extends Model{

    protected $schema = [
        'id'            => 'int',
        'content'       => 'string',
        'lickCount'     => 'int',
        'ipaddress'     => 'string',
        'createdate'    => 'datetime',
        'flag'          => 'int',
    ];

    public function changeFlag($type){
        if ($type == "yes"){
            $this -> flag = 0;
        }else{
            $this -> flag = 2;
        }
        $this -> save();
    }

}