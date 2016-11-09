<?php
/**
 * Function:自定义日志类
 * User: Administrator
 * Date: 2016/10/11
 * Time: 18:11
 */

namespace app\common\controller;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{
    var $log;
    function __construct($loggerName)
    {
        $this->log =new Logger($loggerName);
    }
    public function error($msg=''){
        $this->log->pushHandler(new StreamHandler(BASE_PATH.'logs/'.date('Ymj').'.log', Logger::ERROR));
        $this->log->addError($msg);
    }
    public function info($msg=''){
        $this->log->pushHandler(new StreamHandler(BASE_PATH.'logs/'.date('Ymj').'.log', Logger::INFO));
        $this->log->addInfo($msg);
    }
    public function debug($msg=''){
        $this->log->pushHandler(new StreamHandler(BASE_PATH.'logs/'.date('Ymj').'.log', Logger::DEBUG));
        $this->log->addDebug($msg);
    }
    public function sql($msg=''){
        $this->log->pushHandler(new StreamHandler(BASE_PATH.'logs/'.date('Ymj').'.log', Logger::SQL));
        $this->log->addSql($msg);
    }
}