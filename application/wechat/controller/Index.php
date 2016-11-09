<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26
 * Time: 22:37
 */
namespace app\wechat\controller;

use app\common\controller\Log;
use app\wechat\model\User;
use think\Config;
use think\Db;
use think\View;

class Index
{
    public function index()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echostr = $_GET['echostr'];
        $log = new Log("Index");
        $log->info($signature . '|' . $timestamp . '|' . $nonce . '|' . $echostr);
        $token = 'zl819058637';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            exit($echostr);//返回echostr参数
        }
    }
    /**
     * 获取微信提供的access_token
     * @param string $app_id
     * @param string $app_secret
     * @return string access_token
     */
    public function get_access_token($app_id = '', $app_secret = '')
    {
        try {
            $access_token = cookie('access_token');
            if (!$access_token) {
                $jsonRes = httpGet("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$app_id&secret=$app_secret");
                $access_token = json_decode($jsonRes)->{'access_token'};
                if (json_decode($jsonRes)->{'access_token'}) {
                    cookie('access_token', $access_token, 7200);
                    return $access_token;
                } else {
                    return '';
                }
            } else {
                return $access_token;
            }
        } catch (\Exception $ex) {
            return '';
        }
    }

    public function get_text_msg()
    {
        echo '12222222';
    }

    /**
     * Function:跟微信创建菜单
     * User:ZhangLu
     * @param string $message The log message
     * @param array $context The log context
     * @return Boolean Whether the record has been processed
     */
    public function create_menu()
    {
        if ($_POST) {
            $access_token = $this->get_access_token();
            halt($access_token);
            $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
            $body = "{\"button\":[{\"type\":\"click\",\"name\":\"2bbb\",\"key\":\"V1001_TODAY_MUSIC\"},{\"name\":\"菜单\",\"sub_button\":[{\"type\":\"view\",\"name\":\"搜索\",\"url\":\"http://www.soso.com/\"},{\"type\":\"view\",\"name\":\"视频\",\"url\":\"http://v.qq.com/\"},{\"type\":\"click\",\"name\":\"赞一下我们\",\"key\":\"V1001_GOOD\"}]}]}";
            $jsonRes = httpPost($url, $body);
            halt($jsonRes);
        } else {
            $view = new View();
            $view->replace(Config::get('replace_str'));
            $where = ['rank' => 1];
            $data = Db::name('menu')->where($where)->select();
            $view->assign('data', $data);
            return $view->fetch();
        }
    }

    public function login()
    {
        if ($_POST) {
            $username = input('username');
            $password = input('password');
            $user = new User();
            $res = $user->login($username, $password);
            if ($res) {
                return ['msg' => 'success'];
            } else {
                return ['msg' => 'error'];
            }
        } else {
            $view = new View();
            return $view->replace(config('replace_str'))->fetch();
        }
    }
}