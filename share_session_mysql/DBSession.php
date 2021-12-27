<?php

class DBSession
{
    protected $db = null;
    protected $lifeTime = 0;
    protected $sessTable = '';

    public function __construct($db, $sessTable)
    {
        $this->db = $db;
        $this->sessTable = $sessTable;
        $this->lifeTime = ini_get('session.gc_maxlifetime');

        //ini_set('session.auto_start', 0);
        ini_set('session.save_handler', 'redis');
        session_set_save_handler(
            array($this, "open"),
            array($this, "close"),
            array($this, "read"),
            array($this, "write"),
            array($this, "destroy"),
            array($this, "gc")
        );
        register_shutdown_function('session_write_close');
    }

    public function open($savePath, $sessName)
    {
        return true;
    }

    public function close()
    {
        $this->gc($this->lifeTime);
        return true;
    }

    public function read($sessId)
    {
        $time = time();
        $ret = mysqli_query($this->db, "SELECT `data` FROM `{$this->sessTable}` WHERE `sid`='{$sessId}' AND `expire` > {$time};");
        if ($ret) {
            $row = mysqli_fetch_assoc($ret);
            return $row['data'];
        }
        return '';
    }

    public function write($sessId, $sessData)
    {
        $expire = time() + $this->lifeTime;
        $sessData = mysqli_real_escape_string($this->db, $sessData);

        $ret = mysqli_query($this->db, "SELECT COUNT(*) AS cnt FROM `{$this->sessTable}` WHERE `sid`='{$sessId}';");
        $row = mysqli_fetch_assoc($ret);
//        if($row['cnt']) {
        if ($row) {
            $sql = "UPDATE `{$this->sessTable}` SET `data`='{$sessData}', `expire`={$expire} WHERE `sid`='{$sessId}';";
        } else {
            $sql = "INSERT INTO `{$this->sessTable}` (`sid`,`expire`,`data`) VALUES('{$sessId}',{$expire},'{$sessData}');";
        }
        mysqli_query($this->db, $sql);
        if (mysqli_affected_rows($this->db)) {
            return true;
        }
        return false;
    }

    public function destroy($sessId)
    {
        mysqli_query("DELETE FROM `{$this->sessTable}` WHERE `sid`='{$sessId}';", $this->db);
        if (mysqli_affected_rows($this->db)) {
            return true;
        }
        return false;
    }

    public function gc($lifeTime)
    {
        $time = time();
        mysqli_query($this->db, "DELETE FROM `{$this->sessTable}` WHERE `expire` < {$time};");
        return mysqli_affected_rows($this->db);
    }
}

$sessDb = mysqli_connect('127.0.0.1', 'root', '123456') or die('connect error');
mysqli_select_db($sessDb, 'test') or ('select db error');
mysqli_query($sessDb, 'set names utf8');
$handler = new DBSession($sessDb, 'session');
session_start();