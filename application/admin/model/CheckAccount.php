<?php

/**
 * Function:ad_customer_proxy
 * User: Administrator
 * Date: 2016/9/15
 * Time: 16:25
 */
namespace app\admin\model;

use think\Db;
use think\Exception;
use think\Model;

class CheckAccount extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'ad_customer_proxy';

    public function queryAccount()
    {
        try {
            $date = date("Ymd", strtotime("-1 day"));
            $data = Db::query("select b.customer_name,a.countCnt,a.sumMoney,a.dzCountCnt,a.dzSumMoney,a.dzDate,a.state from ad_customer_proxy as a,ad_customer as b where a.proxy_code=b.proxy_code and a.dzDate=$date ORDER by a.id desc");
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function queryBianminAccount()
    {
        try {
            $date = date("Ymd", strtotime("-1 day"));
            $data = Db::query("select * from bianmin_proxy where dzDate=$date");
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function queryAccountDate($dateMin, $dateMax)
    {
        try {
            $data = Db::query("select b.customer_name,a.countCnt,a.sumMoney,a.dzCountCnt,a.dzSumMoney,a.dzDate,a.state from ad_customer_proxy as a,ad_customer as b where a.proxy_code=b.proxy_code and a.dzDate>=$dateMin and a.dzDate<=$dateMax ORDER by a.id desc");
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function queryBianminAccountDate($dateMin, $dateMax)
    {
        try {
            $data = Db::query("select * from bianmin_proxy where dzDate>=$dateMin and dzDate<=$dateMax");
            return $data;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}