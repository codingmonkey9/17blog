<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';
    protected $primarykey = 'conf_id';
    //允许操作的字段
    public $guarded = [];
    //created_at updated_at
    public $timestamps = false;
}
