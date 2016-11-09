<?php
/**公众号信息
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/6
 * Time: 10:20
 */

namespace app\wechat\model;
use think\Model;

class Publics extends Model
{
    protected $autoWriteTimestamp = true;
    // 关闭自动写入update_time字段
    protected $updateTime = false;
}