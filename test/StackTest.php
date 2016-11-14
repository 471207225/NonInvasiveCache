<?php
/**
 * Created by PhpStorm.
 * User: hmy
 * Date: 16-11-13
 * Time: 下午8:48
 */

require_once "thinkPHPUnit.php";

class StackTest extends PHPUnit_Framework_TestCase
{
    public function testS()
    {
        
    }
    /*
    private $stack;

    //每个测试方法执行前都要运行一遍
    public function setUp()
    {
        $this->stack = array();
        echo '1';
    }

    //每个测试方法运行后都要运行一遍
    public function tearDown()
    {
        echo '2';
    }

    public function testEmpty()
    {
        $this->assertTrue(empty($this->stack));
    }
    public function testPush()
    {
        array_push($this->stack, 'foo');
        $this->assertEquals('foo', $this->stack[count($this->stack)-1]);
        $this->assertFalse(empty($this->stack));
    }
    public function testPop()
    {
        array_push($this->stack, 'foo');
        $this->assertEquals('foo', array_pop($this->stack));
        $this->assertTrue(empty($this->stack));
    }
    */
}