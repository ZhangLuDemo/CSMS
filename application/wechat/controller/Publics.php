<?php
/**
 * 公众号信息
 * User: Administrator
 * Date: 2016/11/5
 * Time: 13:14
 */

namespace app\wechat\controller;


use think\View;

class Publics
{
    /*
     * 查询出当前用户所有公众号信息
     */
    public function index()
    {
        $view = new View();
        $array_publics = db('publics')->where(['uid' => session('uid')])->select();
        if ($array_publics) {
            $view->assign('cnt', count($array_publics));
            $view->assign('array_publics', $array_publics);
        } else {
            $view->assign('cnt', 0);
        }
        return $view->replace(config('replace_str'))->fetch();
    }

    /**
     * 新增加公众号
     */
    public function add_wx()
    {
        $wx_type = input('wx_type');//微信公众号类型，如，订阅号
        $wx_name = input('wx_name');//微信公众号名称，自定义
        $wx_id = input('wx_id');//原始id
        $wx_app_id = input('wx_app_id');//appid
        $wx_app_secret = input('wx_app_secret');//AppSecret
        $wx_token = input('wx_token');//TOKEN
        $wx_encodingAESKey = input('wx_encodingAESKey');//EncodingAESKey
        //先验证是否有效
        $index = new Index();
        $access_token = $index->get_access_token($wx_app_id, $wx_app_secret);
        try {
            if ($access_token != '') {
                $publics_model = new \app\wechat\model\Publics();
                $publics_model->data([
                    'uid' => session('uid'),
                    'wx_type' => $wx_type,
                    'wx_name' => $wx_name,
                    'wx_id' => $wx_id,
                    'wx_app_id' => $wx_app_id,
                    'wx_app_secret' => $wx_app_secret,
                    'wx_token' => $wx_token,
                    'wx_encodingAESKey' => $wx_encodingAESKey,
                    //'create_time' => date('YmdHis', time()),create_time开启了时间戳会自动写入到数据库!
                ]);
                $publics_model->save();
                return ['msg' => 'success'];
            } else {
                throw new \Exception('获取access_token失败,无法保持!');
            }
        } catch (\Exception $ex) {
            return ['msg' => $ex->getMessage()];
        }
    }

    /**
     * 主页
     */
    public function main()
    {
        $id = input('id');
        $view = new View();
        return $view->assign('id',$id)->replace(config('replace_str'))->fetch();
    }
}