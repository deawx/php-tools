<?php
/**
 * @Description:
 * @Author: Mr.LiuQHui
 * @Date: 2020/7/17 2:12 下午
 */


namespace phpTools;

use \DateTime;
use \Exception;
/**
 * @Description: 日期处理类
 * @Class DateTools
 * @Package phpTools
 */
class DateTools
{
    /**
     * @description: 根据时分秒生成时间字符串
     * @param $hours
     * @param $minutes
     * @param $seconds
     * @return string
     * @autor Mr.LiuQHui
     */
    public static function hourGenerate($hours, $minutes, $seconds)
    {
        return implode(':', [$hours, $minutes, $seconds]);
    }

    /**
     * 一日之初
     *
     * @param $date
     *
     * @return string // $date 00:00:00
     */
    public static function dayBeginTime($date)
    {
        $tab = explode(' ', $date);
        if (!isset($tab[1])) {
            $date .= ' ' . self::hourGenerate('00', '00', '00');
        }

        return $date;
    }

    /**
     * 一日之终
     *
     * @param $date
     *
     * @return string  // $date  23:59:59
     */
    public static function dayEndTime($date)
    {
        $tab = explode(' ', $date);
        if (!isset($tab[1])) {
            $date .= ' ' . self::hourGenerate('23', '59', '59');
        }

        return $date;
    }


    /**
     * 返回毫秒数
     * @return int
     */
    public static function getMicroTime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return floor((floatval($sec) + floatval($usec)) * 1000);
    }

    /**
     * 日期推送计算(最小单位是天)
     *
     * @param $interval
     * @param $step
     * @param $date
     *
     * @demo
     *       dateAdd('d', 1, $beginDate); //获取明天
     *
     * @return bool|string
     */
    public static function dateAdd($interval, $step, $date)
    {
        list($year, $month, $day) = explode('-', $date);
        $interval = strtolower($interval);
        if ($interval == 'y') {
            return date(
                'Y-m-d',
                mktime(0, 0, 0, $month, $day, intval($year) + intval($step))
            );
        } elseif ($interval == 'm') {
            return date(
                'Y-m-d',
                mktime(0, 0, 0, intval($month) + intval($step), $day, $year)
            );
        } elseif ($interval == 'd') {
            return date(
                'Y-m-d',
                mktime(0, 0, 0, $month, intval($day) + intval($step), $year)
            );
        }

        return date('Y-m-d');
    }

    /**
     *  Functional description : 计算两个时间相差:几年几月几日几时几分几秒
     *  Programmer : Mr.Liu
     *
     * @param $maxDate YYYY-mm-dd
     * @param $minDate YYYY-mm-dd
     *
     * @return mixed
     * @throws Exception
     */
    public static function DifferTime($maxDate, $minDate)
    {
        $maxDateTime = new DateTime($maxDate);
        $minDateTime = new DateTime($minDate);
        $interval = $maxDateTime->diff($minDateTime);
        $tmp['y'] = $interval->format('%Y');
        $tmp['m'] = $interval->format('%m');
        $tmp['d'] = $interval->format('%d');
        $tmp['H'] = $interval->format('%H');
        $tmp['i'] = $interval->format('%i');
        $tmp['s'] = $interval->format('%s');
        return $tmp;
    }

    /**
     * description: 获取当前日期所在的星期一和星期日
     * @param $date
     * @return array
     * @author: Mr.LiuQHui
     */
    public static function getWeekRange($date)
    {
        $timestamp = strtotime($date);
        $w=strftime('%u',$timestamp);
        $monday = date('Y-m-d',$timestamp-($w-1) * 86400);
        $sunday = date('Y-m-d',$timestamp+(7-$w) * 86400);
        return [$monday,$sunday];
    }
}
