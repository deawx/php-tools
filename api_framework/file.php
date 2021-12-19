<?php
header("Content-Type:text/html;charset=UTF-8");

class File
{
    private $_dir;
    const EXT = '.txt';

    public function __construct()
    {
        $this->_dir = dirname(__FILE__) . "/files/";
    }

    public function cacheData($key, $value = '', $cacheTime = 0)
    {
        $filename = $this->_dir . $key . self::EXT;
        if ($value !== '') {
            //将value值写入缓存
            if (is_null($value)) {
                return @unlink($filename);//删除缓存文件
            }

            $dir = dirname($filename);
            if (!is_dir($dir)) {
                mkdir($dir, 0777);
            }

            $cacheTime = sprintf('%011d', $cacheTime);
            return file_put_contents($filename, $cacheTime . json_encode($value));//设置缓存
        }
        if (!is_file($filename)) {
            return FALSE;
        }
        $contents = file_get_contents($filename);
        $cacheTime = (int)substr($contents, 0, 11);
        $value = substr($contents, 11);
        //缓存文件过期，删除缓存
        if ($cacheTime != 0 && $cacheTime + filemtime($filename) < time()) {
            unlink($filename);
            return FALSE;
        }
        return json_decode($value, true);//获取缓存
    }
}

$file = new File();
$file->cacheData('test1');