<?php
/**
 * Created by PhpStorm.
 * User: hmy
 * Date: 16-11-14
 * Time: 上午10:05
 */
require_once  'thinkPHPUnit.php';
require_once  _EXTENSION_PATH.'MyApp_DbUnit_ArrayDataSet.php';

class DatabaseTest extends PHPUnit_Extensions_Database_TestCase
{
    private static $instance = NULL;
    private static $fixtureInstance = NULL;
    /**
     * 每个测试方法都会执行一遍
     */
    public function getConnection()
    {
        if(self::$instance == NULL){
//          $instance = new PDO(C('DB_TYPE').':host='.C('DB_HOST').';dbname='.C('DB_NAME'),C('DB_USER'),C('DB_PWD'));
            self::$instance = new PDO(C('DB_TYPE').':host=127.0.0.1;dbname='.C('DB_NAME'),C('DB_USER'),C('DB_PWD'));
        }
        return $this->createDefaultDBConnection(self::$instance);
    }

    public function getFixtureConnection()
    {
        if(self::$fixtureInstance == NULL) {
//          $fixtureInstance = new PDO(C('DB_TYPE').':host='.C('DB_HOST').';dbname='.C('DB_NAME'),C('DB_USER'),C('DB_PWD'));
            self::$fixtureInstance = new PDO(C('DB_TYPE') . ':host=127.0.0.1;dbname=wanwan_fixture', C('DB_USER'), C('DB_PWD'));
        }
        return $this->createDefaultDBConnection(self::$fixtureInstance);
    }

    //类前执行
    public static function setUpBeforeClass()
    {
//        echo 'before';
    }

    //类后执行
    public static function tearDownAfterClass()
    {
        self::$instance = NULL;
        self::$fixtureInstance = NULL;
    }

    public function getDataSet()
    {
//        return new MyApp_DbUnit_ArrayDataSet(array(
//            'guestbook' => array(
//                array('id' => 1, 'content' => 'Hello buddy!', 'user' => 'joe'),
//                array('id' => 2, 'content' => 'I like it!',  'user' => null )
//            )
//       ));
        $tablenames = array('ww_lucky_record');
        $dataset = $this->getFixtureConnection()->createDataSet($tablenames);
        return $dataset;
    }

    public function testCal()
    {
        $count = D('luckyRecord')->count();
        assertEquals($count,711);
    }

    public function testCal2()
    {
//        $table = M('luckyRecord')->select();
        $model = M('luckyRecord')->save(['giftCount','1000']);
        $table = $this->getConnection()->createQueryTable('ww_lucky_record','select * from ww_lucky_record');
        $fixtire = $this->getDataSet()->getTable('ww_lucky_record');

        $this->assertTablesEqual($table,$fixtire);

    }
}