<?php
header("Content_Type:text/html;charset=utf-8");

class Db
{
    private static $_instance;//存储单例对象
    private static $_connectSource;//存储连接资源
    private $_dbConfig = array(
        'server' => '***',
        'database' => '***',
        'uid' => '***',
        'pwd' => '***',
    );

    private function __construct()
    {
    }

    //单例
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    //连接sql server数据库
    public function connect()
    {
        if (!self::$_connectSource) {
            self::$_connectSource = sqlsrv_connect($this->_dbConfig['server'],
                array(
                    'Database' => ($this->_dbConfig['database']),
                    'UID' => ($this->_dbConfig['uid']),
                    'PWD' => ($this->_dbConfig['pwd'])
                ));
            if (!self::$_connectSource) {
                // echo "sqlserver connect error:<br />";
                // die(print_r(sqlsrv_errors()));
                throw new Exception(print_r(sqlsrv_errors()));
            }
        }
        return self::$_connectSource;
    }
}



