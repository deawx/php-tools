<?php


use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testSomething(){
        $date = '2020-10-22';
        $d = \phpTools\DateTools::getWeekRange($date);
        $a = getcwd();
        var_dump($a,$d);
    }
}
