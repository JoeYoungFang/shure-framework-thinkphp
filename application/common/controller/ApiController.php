<?php
/** api基础控制  令牌验证方式
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/9 0009
 * Time: 15:26
 */

namespace app\common\controller;

use app\common\manage\UserManage;
use think\App;

class ApiController extends BaseController
{
    public $openId = "";
    public $userId = "";

   public function __construct(App $app = null) {
       parent::__construct($app);
       $this->decryptToken();
   }

    /**
     * 解密用户令牌
     */
   private function decryptToken(){
        $token = request()->header('token');
        //list($this->openId,$this->userId) = UserManage::getInstance()->decryptToken($token);
   }
}