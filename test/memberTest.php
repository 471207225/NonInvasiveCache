<?php
/**
 * Created by PhpStorm.
 * User: hmy
 * Date: 16-11-12
 * Time: 下午6:06
 */
require_once "thinkPHPUnit.php";

class memberTest extends PHPUnit_Framework_TestCase
{

    public function testEmpty()
    {
        $arr = array();
        $this->assertEmpty($arr);
        return $arr;
    }

    /**
     * @depends testEmpty
     */
    public function testPush(array $arr)
    {
        array_push($arr,'foo');
        $this->assertEquals('foo',$arr[count($arr)-1]);
        $this->assertNotEmpty($arr);

        return $arr;
    }

    /**
     * @depends testPush
     */
    public function testPop(array $arr)
    {
        $this->assertEquals('foo',array_pop($arr));
        $this->assertEmpty($arr);
    }

    public function test1()
    {
        return 1;
    }

    public function test2()
    {
        return 2;
    }

    /**
     * @depends test1
     * @depends test2
     */
    public function testTT($a1,$a2)
    {
        $this->assertEquals(1,$a1);
        $this->assertEquals(2,$a2);
    }



    /**
     * @dataProvider additionProvider
     */
    public function testData($a,$b,$c)
    {
//        assertEquals($c, $a + $b);
    }
    
    public function additionProvider()
    {
        return array(
            [2,4,6],
            [4,6,2],
            [8,4,6],
            [12,24,46]
        );
    }

    public function keyProvider()
    {
        return array(
            'adding zeros'  => array(0, 0, 0),
            'zero plus one' => array(0, 1, 1),
            'one plus zero' => array(1, 0, 1),
            'one plus one'  => array(1, 1, 3)
        );
    }

}