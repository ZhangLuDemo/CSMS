<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/13 0013
 * Time: 下午 9:52
 */
namespace app\admin\controller;

use app\common\controller\Auth;
use think\Config;
use think\console\Input;
use think\Controller;
use think\Db;
use think\Exception;
use think\View;

class Login
{
    //首页
    public function main()
    {
        $field = 'id,name,title,sort';
        $where['pid'] = 0;        //顶级ID
        $where['status'] = 1;    //显示状态
        $data = Db::table('db_auth_rule')->field($field)->where($where)->order('sort ASC')->select();
        $auth = new Auth();
        //没有权限的菜单不显示
        foreach ($data as $k => $v) {
            if (!$auth->check($v['name'], session('aid')) && session('aid') != 1) {
                unset($data[$k]);
            } else {
                // status = 1    为菜单显示状态
                $data[$k]['sub'] = Db::table('db_auth_rule')->field($field)->where('pid=' . $v['id'] . ' AND status=1')->order('id ASC')->select();
                $data[$k]['default_name'] = $data[$k]['sub']['0']['name'];
                $data[$k]['default_title'] = $data[$k]['sub']['0']['title'];
                foreach ($data[$k]['sub'] as $k2 => $v2) {
                    if (!$auth->check($v2['name'], session('aid')) && session('aid') != 1) {
                        unset($data[$k]['sub'][$k2]);
                    }
                }
            }
        }
        $view = new View();
        $view->replace(Config::get('replace_str'));
        $filename = session("filename");
        if ($filename == null || $filename == "") {
            $filename = "photo/default.jpg";
        }
        $filepath = Config::get('filepath') . $filename;
        $view->assign(["username" => session('username'), "filepath" => $filepath, 'data' => $data]);
        return $view->fetch();
    }

    public
    function maintest()
    {
        $view = new View();
        $view->replace(Config::get('replace_str'));
        $view->assign("username", $_SESSION["username"]);
        return $view->fetch();
    }

    public
    function memberadd()
    {
        $view = new View();
        $view->replace(Config::get('replace_str'));
        return $view->fetch();
    }

    public
    function menberadd_insert()
    {
        try {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $password_md5 = md5(config("password_md5") . $password);
            $sex = $_POST["sex"];
            $mobile = $_POST["mobile"];
            $email = $_POST["email"];
            $sheng = $_POST["sheng"];
            $shi = $_POST["shi"];
            $quxian = $_POST["quxian"];
            $city = $sheng . ',' . $shi . ',' . $quxian;
            $datetime = date('YmdHis');
            $create_time_int = strtotime($datetime);
            $upload = new Upload();
            $uploadfile = $upload->upload();
            $data = ['username' => $username, 'password' => $password_md5, 'sex' => $sex, 'mobile' => $mobile, 'email' => $email, 'city' => $city, 'create_time' => $datetime, 'create_time_int' => $create_time_int, 'file_name' => $uploadfile];
            Db::table('ad_user')->insert($data);
            return "添加成功!";
        } catch (Exception $e) {
            return "增加用户失败!";
        }
    }

    public function systemlist()
    {
        $view = new View();
        $data = Db::name("user")->select();
        $view->replace(Config::get("replace_str"));
        $view->assign("data", $data);
        return $view->fetch();
    }
}