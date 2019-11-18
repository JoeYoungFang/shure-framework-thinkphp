<?php
/**
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/9 0009
 * Time: 17:09
 */

namespace app\admin\controller;


use app\common\bean\AdminBean;
use app\common\bean\GlobalBean;
use app\common\exception\MyException;
use app\common\manage\AdminManage;
use app\common\utils\ExitJsonUtil;
use app\common\utils\FileUtil;
use think\App;
use think\Controller;
use think\Exception;

class NoCheckPermission extends Controller
{
    /*
     * 不需验证操作权限、但是需要登录
     */
    public function __construct(App $app = null) {
        parent::__construct($app);
        if(!session(GlobalBean::$username)){
            MyException::throwMyException(GlobalBean::$goLogin);
        }
    }

    /** 修改自身信息
     * @return mixed
     * @throws Exception
     */
    public function editSelfMessage(){
        $adminBean = new AdminBean();
        $adminBean->setId(session(GlobalBean::$adminUserId));
        if(request()->isPost()){
            $adminBean->setData(request()->post());
            $result = AdminManage::getInstance()->edit($adminBean,true);
            ExitJsonUtil::getInstance()->exitData($result);
        }
        $adminBean = AdminManage::getInstance()->getInfo($adminBean);
        $this->assign('admin',$adminBean->getData());
        $this->assign('self',true);
        return $this->fetch('admin/edit_user');
    }

    /**
     * 富文本图片上传（layui发文件返回规定格式）
     */
    public function uploadFile() {
        $file = request()->file('file');
        $filePath = FileUtil::getInstance()->uploadFile($file, request()->post('path') ?: "upload");
        $data['code'] = 0;
        if($filePath){
            $data['data'] = array("src" => $filePath,'title' => 'image');
        }else{
            $data['code'] = 1;
            $data['msg'] = FileUtil::getInstance()->getError();
        }
        exit(json_encode($data));
    }

}