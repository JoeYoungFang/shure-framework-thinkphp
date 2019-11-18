<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 19/9/23
 * Time: 11:05
 */

namespace app\common\utils;


use PHPMailer\PHPMailer\PHPMailer;

class QQEmailUtil extends BaseUtil
{
    static $_self = null;

    public static function getInstance(){
        if(empty(self::$_self)){
            self::$_self = new QQEmailUtil();
        }
        return self::$_self;
    }

    /** 发送邮件
     * @param $sendObj
     * @param $subject
     * @param $contnet
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function sendEmail($sendObj,$subject,$contnet){
        $mail = new PHPMailer();// 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
        //$mail->SMTPDebug = 1;// 使用smtp鉴权方式发送邮件
        $mail->isSMTP();// smtp需要鉴权 这个必须是true
        $mail->SMTPAuth = true;
        $mail->Host = config('project.email.host');// 链接qq域名邮箱的服务器地址
        $mail->SMTPSecure = 'ssl';// 设置使用ssl加密方式登录鉴权
        $mail->Port = 465;// 设置ssl连接smtp服务器的远程服务器端口号
        $mail->CharSet = 'UTF-8';// 设置发送的邮件的编码
        $mail->FromName = config('project.email.fromname');// 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名
        $mail->Username = config('project.email.username');// smtp登录的账号 QQ邮箱即可
        $mail->Password = config('project.email.key');// smtp登录的密码 使用生成的授权码
        $mail->From = config('project.email.username');// 设置发件人邮箱地址 同登录账号
        //$mail->isHTML(true);// 邮件正文是否为html编码 注意此处是一个方法
        $mail->addAddress($sendObj);// 设置收件人邮箱地址
        //$mail->addAddress('87654321@163.com');// 添加多个收件人 则多次调用方法即可
        $mail->Subject = $subject;// 添加该邮件的主题
        $mail->Body = $contnet;// 添加邮件正文
        //$mail->addAttachment('./example.pdf');// 为该邮件添加附件
        return $mail->send();// 发送邮件 返回状态
    }
}