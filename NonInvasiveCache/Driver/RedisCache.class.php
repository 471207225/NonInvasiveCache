<?php

/**
 * Created by PhpStorm.
 * User: hmy
 * Date: 16-11-12
 * Time: 上午9:41
 */

namespace  Common\NonInvasiveCache\Driver;
use Common\NonInvasiveCache\Driver\Cache;

class RedisCache implements Cache
{
    /**
     * @param array $options 缓存参数
     * @access public
     */
    public function __construct($options=array()) {
        if ( !extension_loaded('redis') ) {
            E(L('_NOT_SUPPORT_').':redis');
        }
        $options = array_merge(array (
            'host'          => C('REDIS_HOST') ? : '127.0.0.1',
            'port'          => C('REDIS_PORT') ? : 6379,
            'timeout'       => C('DATA_CACHE_TIMEOUT') ? : false,
            'persistent'    => false,
        ),$options);

        $this->options =  $options;
        $this->options['expire'] =  isset($options['expire'])?  $options['expire']  :   C('DATA_CACHE_TIME');
        $this->options['prefix'] =  isset($options['prefix'])?  $options['prefix']  :   C('DATA_CACHE_PREFIX');
        $this->options['length'] =  isset($options['length'])?  $options['length']  :   0;
        $func = $options['persistent'] ? 'pconnect' : 'connect';
        $this->handler  = new \Redis;
        $options['timeout'] === false ?
            $this->handler->$func($options['host'], $options['port']) :
            $this->handler->$func($options['host'], $options['port'], $options['timeout']);
        if ('' != C('REDIS_AUTH')) {
            $this->handler->auth(C('REDIS_AUTH'));
        }
    }

    public function cacheExpire(\Closure $func,$expire=-1,$cacheName=false)
    {
        !$cacheName &&  $cacheName = 'RedisCache_'.date('Y-m-d');
        $rs = $this->handler->get($cacheName);
        if($rs){
            $rs = json_decode($rs,1);
        }
        else{
            $rs = $func();
            $expire = $expire ? $expire : $this->options['expire'];
            $this->handler->set($cacheName,json_encode($rs),$expire);
        }
        return $rs;
    }

    public function __call($func_name,$args)
    {
        return call_user_func_array([$this->handler,$func_name],$args);
    }
}