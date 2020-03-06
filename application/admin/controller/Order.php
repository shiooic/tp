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

        $order = $this->obj::where($data)->paginate(3);
        $page = $order->render();
        $express_status = config('express_status');
        $order_status = config('order_status');
//        print_r($order);
        return $this->fetch('',[
                'order' => $order,
                'page' => $page,
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


    public function search()
    {
        $data = input('get.');

        $sdata = [];
        $search_content = [];
        if(!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['end_time'])> strtotime($data['start_time']))
        {
            $sdata['create_time']  = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        };

        if(!empty($data['name'])){
            $search_content['product']  = ['like', '%'.$data['name'].'%'];
            $search_content['username']  = ['like', '%'.$data['name'].'%'];
            $search_content['tel']  = ['like', '%'.$data['name'].'%'];
        }

//        print_r($sdata);

        $order = $this->obj->where($sdata)->whereOr($search_content)->paginate();
        $page = $order->render();
        $express_status = config('express_status');
        $order_status = config('order_status');
        return $this->fetch('index',[
                'order' => $order,
                'page' => $page,
                'order_status_s' => $order_status,
                'express_status_s' => $express_status,

            ]

        );



    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {

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

    public function excel()
    {
        //
        $users =$this->obj->select();     //数据库查询
        $path = dirname(__FILE__); //找到当前脚本所在路径

        vendor("PHPExcel.PHPExcel"); //方法一

        $PHPExcel = new \PHPExcel();
        $PHPSheet = $PHPExcel->getActiveSheet();
        $PHPSheet->setTitle("demo"); //给当前活动sheet设置名称
        $PHPSheet->setCellValue("A1", "ID")
            ->setCellValue("B1", "手机")
            ->setCellValue("C1", "用户名")
            ->setCellValue("D1", "昵称")
            ->setCellValue("E1", "结束时间")
            ->setCellValue("F1", "等级");
        $i = 2;
        foreach($users as $data){
            $PHPSheet->setCellValue("A" . $i, $data['id'])
                ->setCellValue("B" . $i, $data['username'])
                ->setCellValue("C" . $i, $data['username'])
                ->setCellValue("D" . $i, $data['username'])
                ->setCellValue("E" . $i, $data['username'])
                ->setCellValue("F" . $i, $data['username']);
            $i++;
        }

        $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, "Excel2007");
        header('Content-Disposition: attachment;filename="表单数据.xlsx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件
    }
}
