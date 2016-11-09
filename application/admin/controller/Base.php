<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/11
 * Time: 14:39
 * 用于验证是否登录和验证权限
 */

namespace app\admin\controller;


use app\common\controller\Auth;
use think\Controller;
use think\Request;

class Base extends Controller
{
    public function __construct()
    {
        $token = cookie('token');
        $sessionUserName = session('username');
        //代表未登录
        if (empty($token) || empty($sessionUserName)) {
            cookie($token, null);
            cookie(null, $token);
            session(null);
            header("Location:".config('replace_str')['__CSMS__']);
            exit();
        }else{
            //验证是否有权限访问该菜单
            $request = Request::instance();
            $MODULE_NAME = $request->module();
            $CONTROLLER_NAME = $request->controller();
            $ACTION_NAME = $request->action();
            $action= $MODULE_NAME.'/'.$CONTROLLER_NAME.'/'.$ACTION_NAME;
            $auth = new Auth();
            $reslut = $auth->getPermission($action,session('aid'));
            if(!$reslut){
                echo '你没有权限访问该菜单';
                exit();
            }
        }
    }
}