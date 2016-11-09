<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/3
 * Time: 22:09
 */

namespace app\wechat\model;


use think\Model;

class User extends Model
{
    public function login($username,$password){
        $res = db('users')->where(['nickname'=>$username,'password'=>$password])->find();
        if($res){
            session('uid',$res['uid']);
            return true;
        }else{
            return false;
        }
    }
}