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

}