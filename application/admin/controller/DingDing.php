<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/10
 * Time: 21:32
 */

namespace app\admin\controller;
use BancuAdrian\MysqlBackup\BackupService;
use think\Exception;
use think\Log;

class DingDing extends Base
{
    //先获取钉钉提供access_token
    public function accessToken(){
        $res = httpGet('https://oapi.dingtalk.com/gettoken?corpid=dingfc3ed8a2720dd2e935c2f4657eb6378f&corpsecret=b531AoXKSXGic8SRwg54jlvM-uG228TI5QLYug9XIbMiYoWduo61HrZsHOXc-o0F');
        $resArray = json_decode($res,true);
        $access_token = $resArray['access_token'];
        return $access_token;
    }
    //获取钉钉企业会话消息接口,用来发送给对应的人员
    public function sendMsg($msg='test',$access_token='test'){
        $postUrl = "https://oapi.dingtalk.com/message/send?access_token=$access_token";
        $data['touser']='0124083964102740249';
        $data['agentid']='38882446';//选的公告
        $data['msgtype']='text';
        $data2['content']=$msg;
        $data['text']=$data2;
        $jsonData = json_encode($data);
        Log::info("提交的格式:".$jsonData);
        $res = httpPost($postUrl,$jsonData);
        return $res;
    }
    //查看企业会话是否查看，用来判读是否授权登录
    public function validLogin($messageId='1',$access_token='test'){
        try {
            $postUrl = "https://oapi.dingtalk.com/message/list_message_status?access_token=$access_token";
            $data['messageId'] = $messageId;
            $jsonData = json_encode($data);
            if ($messageId != "") {
                $res = httpPost($postUrl, $jsonData);
                $resArray = json_decode($res,true);
                $readUser = $resArray['read'];
                $unReadUser = $resArray['unread'];
                if (count($readUser)>0 && count($unReadUser) == 0) {
                    return 'success';
                } else {
                    return 'error';
                }
            } else {
                return 'yiChang';
            }
        }catch(Exception $e){
            return 'yiChang';
        }
    }
}

