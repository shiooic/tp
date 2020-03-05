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
//        echo  "order";
//        print_r($this->obj);
        return $this->fetch();
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
