<?php
/**
 * Created by PhpStorm.
 * User: hmy
 * Date: 16-11-14
 * Time: 上午9:29
 */

/**
 * 开启静态变量和全部变量备份还原
 * @backupStaticAttributes disabled
 * @backupGlobals  disabled
 */
class staticTest extends PHPUnit_Framework_TestCase
{
    private static $st = 'aa';

    /**
     * 关闭静态变量和全部变量备份还原
     * @backupStaticAttributes disabled
     * @backupGlobals  disabled
     */
    public function testSt()
    {
        self::$st = 'bb';
    }

    public function testChange()
    {
        echo self::$st;
    }

    public function testNotIncome()
    {
        assertTrue(true,'随便测点什么');
//        $this->markTestIncomplete('还没有测完');
    }

    public function testmarkSkiped()
    {
        echo 'skiped';
//        $this->markTestSkipped('这里跳过了');
    }

    /**
     * @requires PHP 5.3
     * @requires PHPUnit 5.1
     * @requires OS linux
     * @requires function assertTrue
     * @requires extension redis
     */
    public function testRequire()
    {
        echo '条件满足';
    }
}