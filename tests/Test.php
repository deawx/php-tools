<?php


use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testSomething(){
        $date = '2020-02-22';
        $d = \phpTools\DateTools::getMonthRange($date);
        $a = getcwd();
        var_dump($a,$d);
    }
}
