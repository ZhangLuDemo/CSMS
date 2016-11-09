<?php
/**
 * Function:支付对账专用
 * User: ZhangLu
 * Date: 2016/9/15
 * Time: 16:18
 */

namespace app\admin\controller;


use think\View;
class CheckAccount extends Base
{
    public function index()
    {

    }
    
    /**
    * 查询昨日支付宝对账结果
    * @date: 2016年10月8日 下午8:57:41
    * @param: null
    * @return:array
    */
    public function queryAccount()
    {
        if(!empty($_POST)){
        }else{
            $checkAccount = new \app\admin\model\CheckAccount();
            $data = $checkAccount->queryAccount();
            $view = new View();
            return $view->replace(config('replace_str'))->assign('data',$data)->fetch();
        }
    }
    /**
    * 查询昨日便民支付宝对账结果
    * @date: 2016年10月8日 下午8:59:30
    * @param: null
    * @return:array
    */
    public function queryBianminAccount(){
        if(!empty($_POST)){
        }else{
            $checkAccount = new \app\admin\model\CheckAccount();
            $data = $checkAccount->queryBianminAccount();
            $view = new View();
            return $view->replace(config('replace_str'))->assign('data',$data)->fetch();
        }
    }
    /**
    * 根据条件查询出支付宝对账结果
    * @date: 2016年10月8日 下午9:00:24
    * @param:dateMin-开始时间,dateMax-结束时间
    * @return:array
    */
    public function  queryAccountDate(){
        $dateMin = input('dateMin');
        $dateMax = input('dateMax');
        $dateMin = date("Ymd", strtotime($dateMin));
        $dateMax = date("Ymd", strtotime($dateMax));
        $checkAccount = new \app\admin\model\CheckAccount();
        $data = $checkAccount->queryAccountDate($dateMin,$dateMax);
        $view = new View();
        return $view->replace(config('replace_str'))->assign('data',$data)->fetch('queryAccount');
    }
    /**
     * 根据条件查询出便民支付宝对账结果
     * @date: 2016年10月8日 下午9:00:24
     * @param:dateMin-开始时间,dateMax-结束时间s
     * @return:array
     */
    public function  queryBianminAccountDate(){
        $dateMin = input('dateMin');
        $dateMax = input('dateMax');
        $dateMin = date("Ymd", strtotime($dateMin));
        $dateMax = date("Ymd", strtotime($dateMax));
        $checkAccount = new \app\admin\model\CheckAccount();
        $data = $checkAccount->queryBianminAccountDate($dateMin,$dateMax);
        $view = new View();
        return $view->replace(config('replace_str'))->assign('data',$data)->fetch('queryBianminAccount');
    }
}