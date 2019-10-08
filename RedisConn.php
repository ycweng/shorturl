<?php
class RedisConn{
    private static $_instance = null;
    public function __construct(){

        $this->connRedis = new Redis();
        $this->connRedis->connect("127.0.0.1", 6379);
    }
    public static function getInstance(){
        if (self::$_instance ===null){
            self::$_instance= new self();
        }
        return self::$_instance;
    }
    public function exec(){
        return $this->connRedis;
    }
}
?>