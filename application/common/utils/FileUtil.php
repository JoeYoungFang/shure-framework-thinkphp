<?php
/**
 * Created by PhpStorm.
 * User: Administrator--Reer
 * Date: 2019/7/25 0025
 * Time: 10:26
 */

namespace app\common\utils;

use app\common\exception\MyException;
use think\File;

class FileUtil extends BaseUtil
{
    static $_self = null;
    public static function getInstance(){
        if(empty(self::$_self)){
            self::$_self = new FileUtil();
        }
        return self::$_self;
    }

    /** 上传文件
     * @param File $file
     * @param $path
     * @return bool|string
     */
    public function uploadFile(File $file, $path){
        try{
            $info = $file->move($path);
            return "/{$path}/".date("Ymd").'/'.$info->getFilename();
        }catch (\Exception $exception){
            MyException::throwMyException($exception->getMessage());
        }
    }

    /** 下载文件
     * @param $fileDir
     * @param $fileName
     */
    public function downFile($fileDir,$fileName){
        try{
            $file = fopen ( $fileDir . $fileName, "rb" );//以只读和二进制模式打开文件
            Header ( "Content-type: application/octet-stream" );//告诉浏览器这是一个文件流格式的文件
            Header ( "Accept-Ranges: bytes" );//请求范围的度量单位
            Header ( "Accept-Length: " . filesize ( $fileDir . $fileName ) );//Content-Length是指定包含于请求或响应中数据的字节长度
            Header ( "Content-Disposition: attachment; filename=" . $fileName );//用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
            echo fread ( $file, filesize ( $fileDir . $fileName ) );//读取文件内容并直接输出到浏览器
            fclose ( $file );
        }catch (\Exception $exception){
            echo "<script>alert('下载文件失败');history.back(-1);</script>";
        }
        exit ();
    }
}