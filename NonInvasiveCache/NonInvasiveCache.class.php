<?php

/**
 * Created by PhpStorm.
 * User: hmy
 * Date: 16-11-12
 * Time: 上午10:50
 */
namespace Common\NonInvasiveCache;

use Think\Exception;

class NonInvasiveCache{
    const DEFAULT_CACHE_TYPE = 'Redis';


    private $cache;

    public function __construct()
    {
        $this->cache = $this->connect('Redis');
    }

    public function connect($cacheType='',$options=array())
    {
        if(empty($cacheType)) $cacheType = self::DEFAULT_CACHE_TYPE;

        $class = '\\Common\\NonInvasiveCache\\Driver\\'.$cacheType.'Cache';
        if(class_exists($class)){
            $cache = new $class($options);
        }
        else{
            throw new Exception($cacheType.' Driver does not exists');
        }
        return $cache;
    }

    public  function useCacheExpire($func,$expire=-1,$cacheName=false){
        if(is_array($func)){
            if(is_object($func[0]) && is_string($func[1]) && (empty($func[2]) || is_array($func[2]) )){
                empty($func[2]) && $func[2] =array();
                $func = $this->makeClosure($func[0],$func[1],$func[2]);
            }else{
                throw new Exception('First param error');
            }
        }
        $funcRf = new \ReflectionFunction($func);
        if(!$funcRf->isClosure()){
            throw new Exception('First param error,it must be a Closure or Array');
        }

        return $this->cache->cacheExpire($func,$expire,$cacheName);
    }

    public  function makeClosure(&$class,$method,$args=array()){
        $f =    function() use(&$class,&$method,&$args){
//            xdebug_debug_zval( 'class' );//查看引用计数,没有拷贝对象的操作
            return call_user_func_array([$class,$method],$args);
        };
        return $f;
    }

    public static  function instance()
    {
        static $thisCache = false;
        if(!$thisCache){
            $thisCache = new NonInvasiveCache();
        }
        return $thisCache;
    }
}
