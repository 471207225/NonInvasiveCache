<?php
/**
 * Created by PhpStorm.
 * User: hmy
 * Date: 16-11-12
 * Time: 上午11:05
 */

namespace Common\NonInvasiveCache\Driver;

interface Cache{
    public function cacheExpire(\Closure $func,$expire=false,$cacheName=false);
}