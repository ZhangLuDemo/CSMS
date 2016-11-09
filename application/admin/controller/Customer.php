<?php
/**
 * Created by PhpStorm.
 * User: zhanglu
 * Date: 2016/8/21
 * Time: 17:34
 *客服信息
 */

namespace app\admin\controller;


use app\common\controller\Excel;
use think\Config;
use think\Controller;
use think\Db;
use think\Exception;
use think\Request;
use think\View;

class Customer extends Base
{
    public function customerInfo()
    {
        $dateMin = input('dateMin');
        $dateMax = input('dateMax');
        $view = new View();
        $view->replace(Config::get('replace_str'));
        if ($dateMin && $dateMax) {
            $dateMin = $dateMin . ' 00:00:00';
            $dateMax = $dateMax . ' 23:59:59';
            $customerData = Db::query("select * from ad_customer where create_time BETWEEN '$dateMin' AND '$dateMax'");
        } else {
            $customerData = Db::name('customer')->select();
        }
        $view->assign(['customerData' => $customerData]);
        return $view->fetch();
    }

    public function customerAdd()
    {
        $view = new View();
        $view->replace(Config::get('replace_str'));
        $dtCenterData = $this->queryDtCenter();
        $productData = $this->queryProduct();
        $view->assign(['dtCenterData' => $dtCenterData, 'productData' => $productData]);
        return $view->fetch();
    }

    public function customerShow()
    {
        $data = input('data');
        $arrayData = Db::name('customer')->where('customer_id', $data)->find();
        $arrayData = explode('|', implode('|', $arrayData));
        $reslutStrpos = strpos($arrayData[8], ',');
        if ($reslutStrpos) {
            $arrayProductId = explode(',', $arrayData[8]);
            $whereDate = '';
            for ($i = 0; $i < count($arrayProductId); $i++) {
                if ($i == 0) {
                    $whereDate = "product_id=$arrayProductId[$i]";
                } else {
                    $whereDate = $whereDate . ' or ' . "product_id=$arrayProductId[$i]";
                }
            }
            $productData = Db::query("select * from ad_product where $whereDate");
        } else {
            $productData = Db::name('product')->where('product_id', $arrayData[8])->select();
        }

        $dtCenterData = Db::name('dtcenter')->where('dtcenter_id', $arrayData[9])->find();
        $view = new View();
        $view->assign(['arrayData' => $arrayData, 'productData' => $productData, 'dtCenterData' => $dtCenterData, 'file_path' => config('filepath')]);
        $view->replace(Config::get('replace_str'));
        return $view->fetch();
    }

    //添加客服信息
    public function customerInsert()
    {
        try {
            $upload = new Upload();
            //代表上傳logo
            if (isset($_FILES['file'])) {
                $file_path = $upload->upload('ewm/', 'file'); //上传的路径为public下ewm文件夹下
            } else {
                $file_path = '123';
            }
            //代表上傳二維嗎
            if (isset($_FILES['logo'])) {
                $logo_path = $upload->upload('ewm/', 'logo', 'logo_'); //上传的路径为public下ewm文件夹下
            } else {
                $logo_path = "";
            }
            $customer_up = input('customer_up');
            $customer_name = input('customer_name');
            $customer_phone = input('customer_phone');
            $customer_shouxufei = input('customer_shouxufei');
            $customer_sxf_sorts = input('customer_sxf_sorts');
            $customer_state = input('customer_state');
            $customer_count = input('customer_count');
            $customer_dtcenterid = input('dtCenterId');
            $customer_contacts = input('customer_contacts');
            $customer_remote = input('customer_remote');
            $customer_note = input('customer_note');
            $customer_dkrq = input('customer_dkrq');
            $product1 = input('product1');//水务通
            $product2 = input('product2');//微信云
            $product3 = input('product3');//支付宝
            $product4 = input('product4');//慧居城市
            $customer_productid = "";
            if ($product1 != "") {
                $customer_productid = $product1;
            }
            if ($product2 != "") {
                if ($customer_productid != "") {
                    $customer_productid = $customer_productid . "," . $product2;
                } else {
                    $customer_productid = $product2;
                }
            }
            if ($product3 != "") {
                if ($customer_productid != "") {
                    $customer_productid = $customer_productid . "," . $product3;
                } else {
                    $customer_productid = $product3;
                }
            }
            if ($product4 != "") {
                if ($customer_productid != "") {
                    $customer_productid = $customer_productid . "," . $product4;
                } else {
                    $customer_productid = $product4;
                }
            }
            $create_time = date('Y-m-d H:i:s');
            $data = ['customer_name' => $customer_name, 'customer_phone' => $customer_phone, 'customer_shouxufei' => $customer_shouxufei, 'customer_sxf_sorts' => $customer_sxf_sorts, 'customer_state' => $customer_state, 'customer_count' => $customer_count, 'customer_dtcenterid' => $customer_dtcenterid, 'customer_contacts' => $customer_contacts, 'customer_remote' => $customer_remote, 'customer_note' => $customer_note, 'customer_productid' => $customer_productid, 'create_time' => $create_time, 'customer_dkrq' => $customer_dkrq, 'customer_up' => $customer_up, 'customer_ewm' => $file_path, 'customer_logo' => $logo_path];
            Db::name('customer')->insert($data);
            $dingDing = new DingDing();
            $accessToken = $dingDing->accessToken();//先获取token
            $dingDing->sendMsg("新增的客服资料:\n" . '单位名称:' . $customer_name . "\n" . '联系人:' . $customer_contacts . "\n" . '联系电话:' . $customer_phone . "\n" . '远程信息:' . $customer_remote . "\n", $accessToken);//发送消息给钉钉张路,返回对应json
            return array(
                "msg" => "success"
            );
        } catch (Exception $e) {
            return array(
                "msg" => $e->getMessage()
            );
        }
    }

    //更新customer_id
    public function updateCustomerId()
    {
        $customer_id = input('customer_id');
        $customer_state = input('customer_state');
        Db::name('customer')->where('customer_id', $customer_id)->update(['customer_state' => $customer_state]);
    }

    //更新customer
    public function customerUpdate()
    {
        $customerId = input('customerId');
        $sign = input('sign');
        if ($sign == 0) {
            $data = Db::name('customer')->where('customer_id', $customerId)->find();
            //dump($data);
            $view = new View();
            $view->replace(Config::get('replace_str'));
            $view->assign(['data' => $data, 'dtCenterData' => $this->queryDtCenter(), 'productData' => $this->queryProduct()]);
            return $view->fetch();
        } else if ($sign == 1) {
            $customer_up = input('customer_up');
            $customer_name = input('customer_name');
            $customer_phone = input('customer_phone');
            $customer_shouxufei = input('customer_shouxufei');
            $customer_sxf_sorts = input('customer_sxf_sorts');
            $customer_state = input('customer_state');
            $customer_count = input('customer_count');
            $customer_dtcenterid = input('dtCenterId');
            $customer_contacts = input('customer_contacts');
            $customer_remote = input('customer_remote');
            $customer_note = input('customer_note');
            $customer_dkrq = input('customer_dkrq');
            $product1 = input('product1');//水务通
            $product2 = input('product2');//微信云
            $product3 = input('product3');//支付宝
            $product4 = input('product4');//慧居城市
            $customer_productid = "";
            if ($product1 != "") {
                $customer_productid = $product1;
            }
            if ($product2 != "") {
                if ($customer_productid != "") {
                    $customer_productid = $customer_productid . "," . $product2;
                } else {
                    $customer_productid = $product2;
                }
            }
            if ($product3 != "") {
                if ($customer_productid != "") {
                    $customer_productid = $customer_productid . "," . $product3;
                } else {
                    $customer_productid = $product3;
                }
            }
            if ($product4 != "") {
                if ($customer_productid != "") {
                    $customer_productid = $customer_productid . "," . $product4;
                } else {
                    $customer_productid = $product4;
                }
            }
            $create_time = date('Y-m-d H:i:s');
            if (isset($_FILES['file'])) {
                $upload = new Upload();
                $file_path = $upload->upload('ewm/', 'file'); //上传的路径为public下ewm文件夹下
                if (isset($_FILES['logo'])) {
                    $upload = new Upload();
                    $logo_path = $upload->upload('ewm/', 'logo', 'logo_'); //上传的路径为public下ewm文件夹下
                    $data = ['customer_name' => $customer_name, 'customer_phone' => $customer_phone, 'customer_shouxufei' => $customer_shouxufei, 'customer_sxf_sorts' => $customer_sxf_sorts, 'customer_state' => $customer_state, 'customer_count' => $customer_count, 'customer_dtcenterid' => $customer_dtcenterid, 'customer_contacts' => $customer_contacts, 'customer_remote' => $customer_remote, 'customer_note' => $customer_note, 'customer_productid' => $customer_productid, 'create_time' => $create_time, 'customer_dkrq' => $customer_dkrq, 'customer_up' => $customer_up, 'customer_ewm' => $file_path, 'customer_logo' => $logo_path];
                } else {
                    $data = ['customer_name' => $customer_name, 'customer_phone' => $customer_phone, 'customer_shouxufei' => $customer_shouxufei, 'customer_sxf_sorts' => $customer_sxf_sorts, 'customer_state' => $customer_state, 'customer_count' => $customer_count, 'customer_dtcenterid' => $customer_dtcenterid, 'customer_contacts' => $customer_contacts, 'customer_remote' => $customer_remote, 'customer_note' => $customer_note, 'customer_productid' => $customer_productid, 'create_time' => $create_time, 'customer_dkrq' => $customer_dkrq, 'customer_up' => $customer_up, 'customer_ewm' => $file_path];
                }
            } else {
                if (isset($_FILES['logo'])) {
                    $upload = new Upload();
                    $logo_path = $upload->upload('ewm/', 'logo', 'logo_'); //上传的路径为public下ewm文件夹下
                    $data = ['customer_name' => $customer_name, 'customer_phone' => $customer_phone, 'customer_shouxufei' => $customer_shouxufei, 'customer_sxf_sorts' => $customer_sxf_sorts, 'customer_state' => $customer_state, 'customer_count' => $customer_count, 'customer_dtcenterid' => $customer_dtcenterid, 'customer_contacts' => $customer_contacts, 'customer_remote' => $customer_remote, 'customer_note' => $customer_note, 'customer_productid' => $customer_productid, 'create_time' => $create_time, 'customer_dkrq' => $customer_dkrq, 'customer_up' => $customer_up, 'customer_logo' => $logo_path];
                } else {
                    $data = ['customer_name' => $customer_name, 'customer_phone' => $customer_phone, 'customer_shouxufei' => $customer_shouxufei, 'customer_sxf_sorts' => $customer_sxf_sorts, 'customer_state' => $customer_state, 'customer_count' => $customer_count, 'customer_dtcenterid' => $customer_dtcenterid, 'customer_contacts' => $customer_contacts, 'customer_remote' => $customer_remote, 'customer_note' => $customer_note, 'customer_productid' => $customer_productid, 'create_time' => $create_time, 'customer_dkrq' => $customer_dkrq, 'customer_up' => $customer_up,];
                }
            }
            Db::name('customer')->where('customer_id', $customerId)->update($data);
            return array(
                "msg" => "success"
            );
        }
    }

    //删除customer
    public function customerDelete()
    {
        $customer_id = input('customerId');
        Db::name('customer')->where('customer_id', $customer_id)->delete();
    }

    private function queryDtCenter()
    {
        return Db::name('dtcenter')->select();
    }

    private function queryProduct()
    {
        return Db::name('product')->select();
    }

    //根据产品类型查询客服资料
    public function customerQueryType()
    {
        $data = input('data');
        $whereData = "";
        if (isset($data)) {
            $arrayData = str_split($data, 1);
            for ($i = 0; $i < count($arrayData); $i++) {
                if ($i == 0) {
                    $whereData = "where customer_productid like \"%$arrayData[$i]%\"";
                } else {
                    $whereData = $whereData . " and customer_productid like \"%$arrayData[$i]%\"";
                }
            }
        }
        $customerData = Db::query("select * from ad_customer $whereData");
        $view = new View();
        $view->replace(Config::get('replace_str'));
        $view->assign(['customerData' => $customerData]);
        return $view->fetch("customer/customerInfo");
    }

    /**
     * Function:到处excle
     * User:ZhangLu
     * @param nul
     * @return null
     */
    public function exportExcel()
    {
        try {
            $excelHeader = ['客服单位', '联系人', '联系电话', '产品类型', '用戶数', '创建日期'];
            $customer = new \app\admin\model\Customer();
            $excelBodyS = $customer->exportExcel();
            $excel = new Excel();
            $excel->exportExcel(date('Ymj'), $excelHeader, $excelBodyS);
        } catch (Exception $ex) {
            echo Request::instance()->controller().'/'.$ex->getMessage();
        }
    }
}