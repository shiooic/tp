<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Order extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    private $obj;
    public function _initialize()
    {
        $this->obj = model("Order");
    }

    public function index()
    {
        $zt = input('get.order_status', 0, 'intval');
        $data = [
            'order_status' => $zt
        ];

        $order = $this->obj::where($data)->select();
        $express_status = config('express_status');
        $order_status = config('order_status');
//        print_r($order);
        return $this->fetch('',[
                'order' => $order,
                'order_status_s' => $order_status,
                'express_status_s' => $express_status,

            ]

        );
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        if(!request()->isPost()){
            $this->error('请求失败！');
        }
        $data = input('post.');
        $data['order_ip'] = Request::instance()->ip();

        $validate = validate('Order');

        if(!$validate->scene('add')->check($data)){
            return $this->error($validate->getError());
        }
        $res = $this->obj->save($data);

        if($res){
            $this->success("新增成功！");
        }else{
            $this->error("新增失败!");
        }


    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
