<?php
/**
 * 备份相关类
 * @date: 2016年10月8日 下午9:27:59
 * @author: ZhangLu
 */
namespace app\admin\controller;

class Backup extends Base
{
    /**
     * 备份数据库
     * @date: 2016年10月8日 下午9:28:54
     * @param: null
     * @return:null
     */
    public function backup_database()
    {
        // 创建连接
        $conn = mysqli_connect('127.0.0.1', 'root', 'root', 'csms');
        $mysql = "set names utf8;";
        $mysql .= "\n";
        $conn->query($mysql);
        $q1 = $conn->query("show tables");
        while ($t = mysqli_fetch_array($q1)) {
            $table = $t[0];
            $q2 = $conn->query("show create table `$table`");
            $sql = mysqli_fetch_array($q2);
            $mysql .= "DROP TABLE IF EXISTS $table" . ";\n";
            $mysql .= $sql[1] . ";\n";
            $q3 = $conn->query("select * from `$table`");
            while ($data = mysqli_fetch_assoc($q3)) {
                $keys = array_keys($data);
                $keys = array_map('addslashes', $keys);
                $keys = join('`,`', $keys);
                $keys = "`" . $keys . "`";
                $vals = array_values($data);
                $vals = array_map('addslashes', $vals);
                $vals = join("','", $vals);
                $vals = "'" . $vals . "'";
                $mysql .= "insert into `$table`($keys) values($vals);\n";
            }
            $mysql .= "\n";
        }
        $sqlPath =BASE_PATH.'sql/';
        $filename = $sqlPath.date('Ymj').'.sql';
        $fp = fopen($filename, 'w');
        fputs($fp, $mysql);
        fclose($fp);
        echo "数据备份成功";
    }
}
