<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/7
 * Time: 13:47
 * 系统管理
 */

namespace app\admin\controller;

use think\Config;
use think\Controller;
use think\Db;
use think\Exception;
use think\View;

class System extends Base
{
    public function index(){}
    //权限列表
    public function auth_rule()
    {
        if (!empty($_POST)) {
            $data['name'] = input('name');
            $data['title'] = input('title');
            $data['pid'] = input('pid');
            $data['create_time'] = time();
            $res = Db::table('db_auth_rule')->insert($data);
            if ($res) {
                $this->success('添加成功');    //成功
            } else {
                $this->success('添加失败');    //失败
            }
        } else {
            $field = 'id,name,title,create_time,status,sort';
            $data = Db::table('db_auth_rule')->field($field)->where('pid=0')->select();
            foreach ($data as $k => $v) {
                $data[$k]['sub'] = Db::table('db_auth_rule')->field($field)->where('pid=' . $v['id'])->select();
            }
            $view = new View();
            $view->assign('data', $data);    // 顶级
            $view->replace(Config::get('replace_str'));
            return $view->fetch();
        }
    }

    //添加用户组
    public function group_add()
    {
        if (!empty($_POST)) {
            $data['rules'] = $_POST['rules'];//这里用php中$_POST缘故是thinkphp5的input函数不支持数组提交
            if (empty($data['rules'])) {
                $this->error('权限不能为空');
            }
            $data['title'] = input('title');
            $data['rules'] = implode(',', $data['rules']);//变成字符串
            $data['create_time'] = time();
            $res = Db::table('db_auth_group')->insert($data);
            if ($res) {
                $this->success('添加成功', U('System/group_query'));
            } else {
                $this->error('添加失败');
            }
        } else {
            $data = Db::table('db_auth_rule')->field('id,name,title')->where('pid=0')->select();
            foreach ($data as $k => $v) {
                $data[$k]['sub'] = Db::table('db_auth_rule')->field('id,name,title')->where('pid=' . $v['id'])->select();
            }
            $view = new View();
            return $view->replace(Config::get('replace_str'))->assign('data', $data)->fetch();
        }
    }
    //查询用户组
    public function group_query(){
        try {
            $data = Db::table('db_auth_group')->order('id DESC')->select();
            $view = new View();
            return $view->assign('data',$data)->replace(Config::get('replace_str'))->fetch();
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    //修改用户组
    public function group_edit(){
        if(!empty($_POST)){
            $data['id'] = input('id');
            $data['title'] = input('title');
            $data['rules'] = implode(',', $_POST['rules']);
            if(Db::table('db_auth_group')->update($data)){
                return array(
                    "msg" => "success"
                );
            }else{
                return array(
                    "msg" => "error"
                );
            }
        }else{
            $where['id'] = input('id');	//组ID
            $reuslt = Db::table('db_auth_group')->field('id,title,rules')->where($where)->find();
            $reuslt['rules'] = ','.$reuslt['rules'].',';
            $data = Db::table('db_auth_rule')->field('id,title')->where('pid = 0')->select();
            $arr = array();
            foreach ($data as $k => $v){
                $data[$k]['sub'] = Db::table('db_auth_rule')->field('id,title')->where('pid ='.$v['id'])->select();
            }
            $view = new View();
            return $view->assign(['data'=>$data,'reuslt'=>$reuslt])->replace(Config::get('replace_str'))->fetch();
        }
    }
    //添加用户
    public function admin_add()
    {
        if (!empty($_POST)) {
            $upload = new Upload();
            $photo_path = $upload->upload('photo/');
            $data['photo'] = $photo_path;
            $data['account'] = input('account');
            $data['password'] = md5(config("password_md5").input('password'));
            $data['create_time'] = time();        //创建时间
            $where['account'] = input('account');
            $result = Db::table('db_admin')->where($where)->find();
            if (!empty($result)) {
                return ['msg'=>0];
            }
            //添加用户
            $result['uid'] = Db::table('db_admin')->insertGetId($data);
            $result['group_id'] = input('group_id');    //用户组ID
            if ($result['uid']) {
                $group_access = Db::table('db_auth_group_access');
                //分配用户组
                if ($group_access->insert($result)) {
                    return ['msg'=>1];    //分配用户组成功
                } else {
                    return ['msg'=>2];    //分配用户组失败
                }
            } else {
                return ['msg'=>0];  //添加用户失败
            }
        } else {
            $data = Db::table('db_auth_group')->field('id,title')->select();
            $view = new View();
            return $view->assign('data', $data)->replace(Config::get('replace_str'))->fetch();
        }
    }

    //检查账号是否已存在
    public function check_account(){
        $where['account'] = input('account');	//账号
        $data = Db::table('db_admin')->field('id')->where($where)->find();
        if(empty($data)){
            return '0';   //不存在
        }else{
            return '1';	//存在
        }
    }
    //删掉用户组
    public function group_del(){
        try{
            $id = input('id');
            Db::table('db_auth_group')->where('id',$id)->delete();
            return ['msg'=>'ok'];
        }catch(Exception $e){
            return ['msg'=>$e->getMessage()];
        }
    }
}