<?php

namespace app\admin\model;

use think\Model;

class Order extends Model
{
    //
    protected $autoWriteTimestamp = true;
    protected $readonly = ['order_ip'];
}
