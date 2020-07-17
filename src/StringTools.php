<?php
/**
 * @Description: 字符串处理工具
 * @Author: Mr.LiuQHui
 * @Date: 2020/7/17 11:51 上午
 */

namespace phpTools;
/**
 * @Description:
 * @Class StringTools
 * @Package phpTools
 */
class StringTools
{
    /**
     * @description: 计算字符串长度
     * @param $str
     * @param string $encoding
     * @return bool|int
     * @autor Mr.LiuQHui
     */
    public static function strlen(string $str, $encoding = 'UTF-8')
    {
        if (is_array($str) || is_object($str)) {
            return false;
        }
        $str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
        if (function_exists('mb_strlen')) {
            return mb_strlen($str, $encoding);
        }
        return strlen($str);
    }
}