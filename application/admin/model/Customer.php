<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-10-16
 * Time: 上午9:59
 */

namespace app\admin\model;


use think\Db;
use think\image\Exception;
use think\Model;
use think\Request;

class Customer extends Model
{

    public function exportExcel()
    {
        try {
            $excelBodyS = [];
            $customerDataS = Db::name('customer')->select();
            $newProductData = $this->queryProduct();//先查询出所以的产品类型
            for ($i = 0; $i < count($customerDataS); $i++) {
                $whereDate = '';
                if (empty($customerDataS[$i]['customer_productid'])) {
                    $whereDate = '无';
                } else {
                    $reslutStrpoS = strpos($customerDataS[$i]['customer_productid'], ',');
                    if ($reslutStrpoS) {
                        $arrayProductId = explode(',', $customerDataS[$i]['customer_productid']);
                        for ($j = 0; $j < count($arrayProductId); $j++) {
                            $whereDate = $whereDate . ',' . $newProductData[$arrayProductId[$j]];
                        }
                    } else {
                        $whereDate = $newProductData[$customerDataS[$i]['customer_productid']];
                    }
                }
                $excelBodyS[$i] = [$customerDataS[$i]['customer_name'], $customerDataS[$i]['customer_contacts'], $customerDataS[$i]['customer_phone'], $whereDate, $customerDataS[$i]['customer_count'], $customerDataS[$i]['create_time']];
            }
            return $excelBodyS;
        } catch (Exception $ex) {
            return Request::instance()->controller() . '/' . $ex->getMessage();
        }
    }

    private
    function queryProduct()
    {
        try {
            $newProductData = [];
            $productDataS = Db::name('product')->select();
            foreach ($productDataS as $productData) {
                $newProductData[$productData['product_id']] = $productData['product_name'];
            }
            return $newProductData;
        } catch (\think\Exception $ex) {
            return Request::instance()->controller() . '/' . $ex->getMessage();
        }
    }
}