<?php
/**
 * File       : mysqlproxy.php
 * Time       : 14-8-18 下午10:42
 * Author     : star
 * Description: 一个简单的应用反射实现动态代理示例
 */
class mysql{
    public function connect($db){
        echo "connect mysql [{$db}]".PHP_EOL;
    }
}

class sqlproxy{
    private $target;
    public function __construct($tar){
        $this->target[] = new $tar();
    }

    public function __call($name,$args){
        foreach($this->target as $obj){
            $r = new ReflectionClass($obj);
            if($method = $r->getMethod($name)){
                if($method->isPublic() && !$method->isAbstract()){
                    echo "method before log".PHP_EOL;
                    $method->invoke($obj,$args[0]);
                    echo "method after log".PHP_EOL;
                }
            }
        }
    }
}
$obj = new sqlproxy("mysql");
$obj->connect('test');