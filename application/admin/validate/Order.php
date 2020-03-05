<?php


namespace app\admin\validate;
use think\Validate;

class Order extends Validate
{
    protected $rule = [
        ['product' , 'require', '产品名不能为空'],
        ['num' , 'require|number','数量必须是数字'],
        ['username' , 'require', '收件人不能为空'],
        ['address' , 'require', '收货地址不能为空'],
        ['tel','require|max:11|/^1[3-8]{1}[0-9]{9}$/','请输入手机号码|手机号码最多不能超过11个字符|手机号码格式不正确']
    ];

}