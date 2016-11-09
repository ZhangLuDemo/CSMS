<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: luofei614 <weibo.com/luofei614>　
// +----------------------------------------------------------------------
namespace app\common\controller;

use think\Config;
use think\Db;
use think\Exception;

/**
 * 权限认证类
 * 功能特性：
 * 1，是对规则进行认证，不是对节点进行认证。用户可以把节点当作规则名称实现对节点进行认证。
 *      $auth=new Auth();  $auth->check('规则名称','用户id')
 * 2，可以同时对多条规则进行认证，并设置多条规则的关系（or或者and）
 *      $auth=new Auth();  $auth->check('规则1,规则2','用户id','and')
 *      第三个参数为and时表示，用户需要同时具有规则1和规则2的权限。 当第三个参数为or时，表示用户值需要具备其中一个条件即可。默认为or
 * 3，一个用户可以属于多个用户组(think_auth_group_access表 定义了用户所属用户组)。我们需要设置每个用户组拥有哪些规则(think_auth_group 定义了用户组权限)
 *
 * 4，支持规则表达式。
 *      在think_auth_rule 表中定义一条规则时，如果type为1， condition字段就可以定义规则表达式。 如定义{score}>5  and {score}<100  表示用户的分数在5-100之间时这条规则才会通过。
 */

//数据库
/*
-- ----------------------------
-- think_auth_rule，规则表，
-- id:主键，name：规则唯一标识, title：规则中文名称 status 状态：为1正常，为0禁用，condition：规则表达式，为空表示存在就验证，不为空表示按照条件验证
-- ----------------------------
DROP TABLE IF EXISTS db_admin;
CREATE TABLE `db_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `account` varchar(32) DEFAULT NULL COMMENT '管理员账号',
  `password` varchar(36) DEFAULT NULL COMMENT '管理员密码',
  `login_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `login_count` mediumint(8) NOT NULL COMMENT '登录次数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账户状态，禁用为0   启用为1',
  `photo` varchar(50) DEFAULT NULL COMMENT '头像',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
insert into `db_admin`(`id`,`account`,`password`,`login_time`,`login_count`,`status`,`photo`,`create_time`) values('18','zhanglu','8af106be3540a6d1b9f03a97024f8072','','0','1','photo/c20ad4d720160909231552.jpg','1473242722');
insert into `db_admin`(`id`,`account`,`password`,`login_time`,`login_count`,`status`,`photo`,`create_time`) values('28','admin','fa0c664137933dfe720f3398b5bf36ad','','0','1','photo/c20ad4d720160909231552.jpg','1473434152');

DROP TABLE IF EXISTS db_auth_group;
CREATE TABLE `db_auth_group` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
insert into `db_auth_group`(`id`,`title`,`status`,`rules`,`create_time`) values('34','最高权限分组','1','14,15,16,17,20,18,19,21,22,23,24,25,26,27','1473242709');

DROP TABLE IF EXISTS db_auth_group_access;
CREATE TABLE `db_auth_group_access` (
  `uid` smallint(5) unsigned NOT NULL,
  `group_id` smallint(5) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
insert into `db_auth_group_access`(`uid`,`group_id`) values('18','34');
insert into `db_auth_group_access`(`uid`,`group_id`) values('28','34');

DROP TABLE IF EXISTS db_auth_rule;
CREATE TABLE `db_auth_rule` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '',
  `title` varchar(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` smallint(5) NOT NULL COMMENT '父级ID',
  `sort` tinyint(4) NOT NULL DEFAULT '50' COMMENT '排序',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL,
  `remark` varchar(30) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('14','admin/System/index','系统管理','1','1','','0','50','1473241480','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('15','admin/System/auth_rule','权限菜单','1','1','','14','50','1473241691','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('16','admin/System/group_add','添加用户组','1','1','','14','50','1473241721','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('17','admin/System/admin_add','添加用户','1','1','','14','50','1473241757','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('18','admin/Customer/index','客服管理','1','1','','0','50','1473241874','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('19','admin/Customer/customerInfo','客服列表','1','1','','18','50','1473241908','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('20','admin/System/group_query','用户组','1','1','','14','50','1473301379','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('21','admin/DingDing/index','钉钉测试','1','1','','0','50','1473514276','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('22','admin/DingDing/accessToken','获取AccessToken','1','1','','21','50','1473514319','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('23','admin/CheckAccount /index','支付宝对账','1','1','','0','50','1473736997','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('24','admin/CheckAccount/queryAccount','对账查询','1','1','','23','50','1473737034','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('25','admin/CheckAccount/queryBianminAccount','重庆便民','1','1','','23','50','1474000796','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('26','admin/Backup/index','备份','1','1','','0','50','1475932862','','');
insert into `db_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`sort`,`create_time`,`update_time`,`remark`) values('27','admin/Backup/backup_database','备份数据库','1','1','','26','50','1475933020','','');
 */

class Auth
{

    //默认配置
    protected $_config = array(
        'AUTH_ON' => true,                      // 认证开关
        'AUTH_TYPE' => 1,                         // 认证方式，1为实时认证；2为登录认证。
        'AUTH_GROUP' => 'auth_group',        // 用户组数据表名
        'AUTH_GROUP_ACCESS' => 'auth_group_access', // 用户-用户组关系表
        'AUTH_RULE' => 'auth_rule',         // 权限规则表
        'AUTH_USER' => 'member'             // 用户信息表
    );

    public function __construct()
    {
        $prefix = 'db_';
        $this->_config['AUTH_GROUP'] = $prefix . $this->_config['AUTH_GROUP'];
        $this->_config['AUTH_RULE'] = $prefix . $this->_config['AUTH_RULE'];
        $this->_config['AUTH_USER'] = $prefix . $this->_config['AUTH_USER'];
        $this->_config['AUTH_GROUP_ACCESS'] = $prefix . $this->_config['AUTH_GROUP_ACCESS'];
        if (Config::get('AUTH_CONFIG')) {
            //可设置配置项 AUTH_CONFIG, 此配置项为数组。
            $this->_config = array_merge($this->_config, Config::get('AUTH_CONFIG'));
        }
    }

    /**
     * 检查权限
     * @param name string|array  需要验证的规则列表,支持逗号分隔的权限规则或索引数组
     * @param uid  int           认证用户的id
     * @param string mode        执行check的模式
     * @param relation string    如果为 'or' 表示满足任一条规则即通过验证;如果为 'and'则表示需满足所有规则才能通过验证
     * @return boolean           通过验证返回true;失败返回false
     */
    public function check($name, $uid, $type = 1, $mode = 'url', $relation = 'or')
    {
        if (!$this->_config['AUTH_ON'])
            return true;
        $authList = $this->getAuthList($uid, $type); //获取用户需要验证的所有有效规则列表
        if (is_string($name)) {
            $name = strtolower($name);
            if (strpos($name, ',') !== false) {
                $name = explode(',', $name);
            } else {
                $name = array($name);
            }
        }
        $list = array(); //保存验证通过的规则名
        if ($mode == 'url') {
            $REQUEST = unserialize(strtolower(serialize($_REQUEST)));
        }
        foreach ($authList as $auth) {
            $query = preg_replace('/^.+\?/U', '', $auth);
            if ($mode == 'url' && $query != $auth) {
                parse_str($query, $param); //解析规则中的param
                $intersect = array_intersect_assoc($REQUEST, $param);
                $auth = preg_replace('/\?.*$/U', '', $auth);
                if (in_array($auth, $name) && $intersect == $param) {  //如果节点相符且url参数满足
                    $list[] = $auth;
                }
            } else if (in_array($auth, $name)) {
                $list[] = $auth;
            }
        }
        if ($relation == 'or' and !empty($list)) {
            return true;
        }
        $diff = array_diff($name, $list);
        if ($relation == 'and' and empty($diff)) {
            return true;
        }
        return false;
    }

    /**
     * 根据用户id获取用户组,返回值为数组
     * @param  uid int     用户id
     * @return array       用户所属的用户组 array(
     *     array('uid'=>'用户id','group_id'=>'用户组id','title'=>'用户组名称','rules'=>'用户组拥有的规则id,多个,号隔开'),
     *     ...)
     */
    public function getGroups($uid)
    {
        static $groups = array();
        if (isset($groups[$uid]))
            return $groups[$uid];
        $auth_group = $this->_config['AUTH_GROUP'];
        $AUTH_GROUP_ACCESS = $this->_config['AUTH_GROUP_ACCESS'];
//        $user_groups = Db::table($this->_config['AUTH_GROUP_ACCESS'] )
//            ->alias('a')
//            ->join("$auth_group g", 'a.group_id=g.id')
//            ->where("a.uid=$uid and g.status='1'")
//            ->field('uid,group_id,title,rules')->select();
        $user_groups = Db::query("select uid,group_id,title,rules from $AUTH_GROUP_ACCESS as a inner join $auth_group as g on a.group_id=g.id where a.uid=? and g.status=?", [$uid, 1]);
        $groups[$uid] = $user_groups ?: array();
        return $groups[$uid];
    }

    /**
     * 获得权限列表
     * @param integer $uid 用户id
     * @param integer $type
     */
    protected function getAuthList($uid, $type)
    {
        static $_authList = array(); //保存用户验证通过的权限列表
        $t = implode(',', (array)$type);
        if (isset($_authList[$uid . $t])) {
            return $_authList[$uid . $t];
        }
        if ($this->_config['AUTH_TYPE'] == 2 && isset($_SESSION['_AUTH_LIST_' . $uid . $t])) {
            return $_SESSION['_AUTH_LIST_' . $uid . $t];
        }

        //读取用户所属用户组
        $groups = $this->getGroups($uid);
        $ids = array();//保存用户所属用户组设置的所有权限规则id
        foreach ($groups as $g) {
            $ids = array_merge($ids, explode(',', trim($g['rules'], ',')));
        }
        $ids = array_unique($ids);
        if (empty($ids)) {
            $_authList[$uid . $t] = array();
            return array();
        }

        $map = array(
            'id' => array('in', $ids),
            'type' => $type,
            'status' => 1,
        );
        //读取用户组所有权限规则
        $rules = Db::table($this->_config['AUTH_RULE'])->where($map)->field('condition,name')->select();
        //循环规则，判断结果。
        $authList = array();   //
        foreach ($rules as $rule) {
            if (!empty($rule['condition'])) { //根据condition进行验证
                $user = $this->getUserInfo($uid);//获取用户信息,一维数组

                $command = preg_replace('/\{(\w*?)\}/', '$user[\'\\1\']', $rule['condition']);
                //dump($command);//debug
                @(eval('$condition=(' . $command . ');'));
                if ($condition) {
                    $authList[] = strtolower($rule['name']);
                }
            } else {
                //只要存在就记录
                $authList[] = strtolower($rule['name']);
            }
        }
        $_authList[$uid . $t] = $authList;
        if ($this->_config['AUTH_TYPE'] == 2) {
            //规则列表结果保存到session
            $_SESSION['_AUTH_LIST_' . $uid . $t] = $authList;
        }
        return array_unique($authList);
    }

    /**
     * 获得用户资料,根据自己的情况读取数据库
     */
    protected function getUserInfo($uid)
    {
        static $userinfo = array();
        if (!isset($userinfo[$uid])) {
            $userinfo[$uid] = Db::table($this->_config['AUTH_USER'])->where(array('uid' => $uid))->find();
        }
        return $userinfo[$uid];
    }

    /*
     * zhanglu
     * 根据菜单名验证用户是否有有权限访问，用于非法访问
     */
    public function getPermission($auth_rule_name = "", $uid = "")
    {
        try {
            $auth_rule_array = Db::table($this->_config['AUTH_RULE'])->field('id')->where(array('name' => $auth_rule_name))->find();
            if($auth_rule_array) {
                $auth_rule_id = $auth_rule_array['id'];
                $auth_group_access_array = Db::table($this->_config['AUTH_GROUP_ACCESS'])->field('group_id')->where(array('uid' => $uid))->find();
                $auth_group_access_group_id = $auth_group_access_array['group_id'];
                $resultArray = Db::table($this->_config['AUTH_GROUP'])->field('rules')->where('id', $auth_group_access_group_id)->find();
                if ($resultArray) {
                    $result = explode(',', $resultArray['rules']);
                    if (in_array($auth_rule_id, $result)) {
                        return true;//有權限
                    } else {
                        return false;//無權限
                    }
                } else {
                    return false;//無權限
                }
            }else{
                return true;//非菜单无需验证权限
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
