<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 2019-06-28
 * Time: 17:25
 */

namespace app\common\exception;

use app\common\bean\GlobalBean;
use app\common\bean\ListMap;
use app\common\utils\ExitJsonUtil;
use Exception;
use think\Db;
use think\exception\Handle;
use think\exception\HttpException;
use think\facade\Log;
use think\Response;

class MyException extends Handle
{

    public function render(Exception $e){
        $listMap = new ListMap();
        $listMap->setParameter("errorFile",$e->getFile());
        $listMap->setParameter("errorMsg",$e->getMessage());
        $listMap->setParameter('errorLine',$e->getLine());
        if(!($e instanceof HttpException)){ //错误日志记录
            file_put_contents("error/".date('Ymd')."error.txt",json_encode($listMap->getData())."\n",FILE_APPEND);
            Log::init([
                'type' => 'File',
                'level' => ['error']
            ]);
            Log::record($e->getMessage(), 'error');
            Log::record('异常前执行sql:'.Db::table('')->getLastSql(), 'error');
        }
        if(strtolower(request()->module()) == 'api'){
            $errcode = config('errcode.');
            $errorCodeBool = isset($errcode[$e->getMessage()]);
            ExitJsonUtil::getInstance()->exitData(null,$errorCodeBool ? $e->getMessage() : 400, $errorCodeBool ? $errcode[$e->getMessage()] : $e->getMessage());
        }
        if(preg_match('/[\x{4e00}-\x{9fa5}]/u', $e->getMessage()) > 0 && request()->isAjax()){
            return Response::create($listMap->getData(), 'json', 400, [], []);
        }
        if($e->getMessage() == GlobalBean::$goLogin){
            $url = request()->module()."/Login/login";
            echo "<script>top.location.href = '".url($url)."';</script>";exit();
        }
        return parent::render($e);
    }

    /** 抛出异常
     * @param $message
     */
    public static function throwMyException($message){
        throw new HttpException(404, $message);
    }
}