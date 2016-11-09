<?php
/**
 * 自定义菜单
 */
namespace app\wechat\controller;

use think\Controller;
use think\View;

class CustomMenu extends Controller
{
    /**
     * 主页面
     */
    public function index()
    {
        $id = input('id');
        $view = new View();
        return $view->assign('id',$id)->replace(config('replace_str'))->fetch();
    }

    /**
     * 添加菜单
     */
    public function add()
    {
        $id = input('id');
        //获取自定义菜单接口可实现多种类型按钮
        $custom_menu_click_type = db('custom_menu_click_type')->select();
        $view = new View();
        return $view->assign('id',$id)->assign('custom_menu_click_type',$custom_menu_click_type)->replace(config('replace_str'))->fetch();
    }
}
