<?php
/**
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/9/9 0009
 * Time: 15:26
 */

namespace app\common\controller;


use think\App;
use think\Controller;

class BaseController extends Controller
{
    protected $postParams = [];
    protected $getParams = [];

    /** 初始化 post、get参数
     * BaseController constructor.
     * @param App|null $app
     */
    public function __construct(App $app = null) {
        parent::__construct($app);
        $this->postParams = request()->post();
        $this->getParams = request()->get();
    }

    /** 添加post参数
     * @param $key
     * @param $value
     */
    public function appendPostParam($key,$value){
        $this->postParams[$key] = $value;
    }

    /**获取post参数
     * @param $key
     * @return mixed
     */
    public function getPostParam($key){
        return $this->postParams[$key] ?? '';
    }

    /** 添加get参数
     * @param $key
     * @param $value
     */
    public function appendGetParam($key,$value){
        $this->getParams[$key] = $value;
    }

    /** 获取get参数
     * @param $key
     * @return mixed|string
     */
    public function getGetParam($key){
        return $this->getParams[$key] ?? '';
    }
}