<?php
/**
 * Function:
 * User: Administrator
 * Date: 2016/10/14
 * Time: 16:38
 */

namespace app\common\controller;


class Excel
{
    public function exportExcel($fileName = '', $exportDataHeaders = '', $exportDataBodys = '')
    {
        try {
            set_include_path(EXTEND_PATH . 'phpoffice/phpexcel/Classes/');
            require_once('PHPExcel.php');
            require_once('PHPExcel/Writer/Excel5.php');
            //创建一个excel
            $objPHPExcel = new \PHPExcel();
            //保存excel—2007格式
            //或者$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 非2007格式
            $objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
            /*
             * 接下来就是写数据到表格里面去
             */
            //excel头
            $i = 'A';
            foreach($exportDataHeaders as $exportDataHeader){
                $objPHPExcel->getActiveSheet()->setCellValue($i.'1',$exportDataHeader);//这里是设置A1单元格的内容
                $i++;
            }
            //excel体
            $j = '2';
            foreach($exportDataBodys as $exportDataBody){
                $b = 'A';
                foreach($exportDataBody as $data){
                    $objPHPExcel->getActiveSheet()->setCellValue($b.$j, $data);//这里是设置A1单元格的内容
                    $b++;
                }
                $j++;
            }

            //接下来当然是下载这个表格了，在浏览器输出就好了
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
            header("Content-Type:application/force-download");
            header("Content-Type:application/vnd.ms-execl");
            header("Content-Type:application/octet-stream");
            header("Content-Type:application/download");;
            header("Content-Disposition:attachment;filename=$fileName.xlsx");
            header("Content-Transfer-Encoding:binary");
            $objWriter->save('php://output');
            $objWriter->save("$fileName.xlsx");
        } catch (\think\Exception $ex) {
            return $ex->getMessage();
        }
    }
}