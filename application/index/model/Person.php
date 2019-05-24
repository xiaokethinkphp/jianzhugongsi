<?php
namespace app\index\model;

use \think\Model;
/**
 *
 */
class Person extends Model
{
    public function department()
    {
        return $this->belongsTo("Person");
    }
}
