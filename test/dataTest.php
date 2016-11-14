<?php
/**
 * Created by PhpStorm.
 * User: hmy
 * Date: 16-11-13
 * Time: 下午3:42
 */

require_once 'thinkPHPUnit.php';

class dataTest extends PHPUnit_Framework_TestCase
{

    public function testFirst()
    {
        return 'first';
    }

    public function testSecond()
    {
        return 'second';
    }

    public function provider()
    {
        return array(
            ['provider']
        );
    }

    /**
     * @depends testFirst
     * @depends testSecond
     * @dataProvider  provider
     */
    public function testData()
    {
        assertEquals(array('provider','first','second'),func_get_args());
    }

    public function ecc()
    {
        echo 'foo';
    }

    public function testOutPut()
    {
        $this->expectOutputString('foo');
        $this->ecc();

    }
}