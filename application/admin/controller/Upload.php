<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/17 0017
 * Time: 下午 10:52
 */

namespace app\admin\controller;

class Upload extends Base
{
    public function upload($path = "upload/", $file_name = '', $identify = '')
    {
        // 允许上传的图片后缀
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES[$file_name]["name"]);
        //echo $_FILES["file"]["size"];
        $extension = end($temp);     // 获取文件后缀名
        if ((($_FILES[$file_name]["type"] == "image/gif")
                || ($_FILES[$file_name]["type"] == "image/jpeg")
                || ($_FILES[$file_name]["type"] == "image/jpg")
                || ($_FILES[$file_name]["type"] == "image/pjpeg")
                || ($_FILES[$file_name]["type"] == "image/x-png")
                || ($_FILES[$file_name]["type"] == "image/png"))
            && ($_FILES[$file_name]["size"] < 204800)   // 小于 200 kb
            && in_array($extension, $allowedExts)
        ) {
            if ($_FILES[$file_name]["error"] > 0) {
                echo "错误：: " . $_FILES[$file_name]["error"] . "<br>";
            } else {
                // 判断当期目录下的 upload 目录是否存在该文件
                // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
                if (file_exists($path . $_FILES[$file_name]["name"])) {
                    echo $_FILES[$file_name]["name"] . " 文件已经存在。 ";
                } else {
                    // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                    $filename = $_FILES[$file_name]["name"];
                    $hello = explode('.', $filename);
                    $date = date('YmdHis');
                    $filename = $identify . substr(md5($hello[0]), 0, 8) . $date . '.' . $hello[1];
                    move_uploaded_file($_FILES[$file_name]["tmp_name"], $path . $filename);
                    return $path . $filename;
                }
            }
        } else {
            echo "非法的文件格式";
        }
    }
}
