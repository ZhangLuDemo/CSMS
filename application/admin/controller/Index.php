<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/13 0013
 * Time: 下午 10:00
 */
namespace app\admin\controller;

use app\common\controller\Log;
use think\Config;
use think\Controller;
use think\Db;
use think\View;

class Index
{

    public function index()
    {
        //先判断token是否存在
        $token = cookie('token');
        if (!empty($token)) {
            header("Location:".config('replace_str')['__CSMS__'].'admin/Login/main.html');
            exit();
        } else {
            if (!empty($_POST)) {
                $username = input("username");
                $my_md5 = Config::get('password_md5');
                $data = input('post.captcha');
                if (!captcha_check($data)) {
                    return array(
                        "msg" => 'yzmerror'
                    );
                } else {
                    $username_token = md5(md5($username . $my_md5 . time()));
                    $password = input("password");
                    $password_md5 = md5(config("password_md5") . $password);
                    $data = Db::table('db_admin')->where('account', $username)->find();
                    $result = Db::table('db_admin')->where('account', $username)->where('password', $password_md5)->find();
                    if ($data) {
                        if ($result) {
                            cookie("token", $username_token, config('cache_time'));
                            session('username', $username);//保存seesion
                            session('filename', $result["photo"]);
                            session('aid', $result['id']);
                            $myLog = new Log('IndexController');
                            $myLog->info($username.'....登陆成功!');
                            return array(
                                "msg" => 'success'
                            );
                        } else {
                            return array(
                                "msg" => 'passerror'
                            );
                        }
                    } else {
                        return array(
                            "msg" => 'usererror'
                        );
                    }
                }
            } else {
                $view = new View();
                $view->replace(Config::get('replace_str'));
                return $view->fetch();
            }
        }
    }

    public function login()
    {
        cookie('token', null);
        session(null);
        $view = new View();
        $view->replace(Config::get('replace_str'));
        return $view->fetch('index');
    }

    public function validDing($username = 'test')
    {
        $dingDing = new DingDing();
        $accessToken = $dingDing->accessToken();//先获取token
        $resJson = $dingDing->sendMsg('你好张路!' . $username . '登录了客服中心系统!', $accessToken);//发送消息给钉钉张路,返回对应json
        $resArray = json_decode($resJson, true);
        $messageId = $resArray['messageId'];
        while (true) {
            $resString = $dingDing->validLogin($messageId, $accessToken);//验证这个消息是否被钉钉张路阅读，阅读代表授权登录，未阅读代表继续循环
            if ($resString == "success") {
                break;
            }
        }
    }
}
