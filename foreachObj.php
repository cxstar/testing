<?php
/**
 * File       : foreachObj.php
 * Time       : 14-8-20 下午8:37
 * Author     : star
 * Description: foreach an object
 */
class test{
    public $prop1 = 1;
    public $prop2 = "prop 2";

    protected $ppp = "protected";

    private $prvp = "private";

    public function hello(){
        echo "hello";
    }

    private function bye(){
        echo "bye";
    }

    public function setP1($prop){
        $this->prop1 = $prop;
    }
}
$a = new test();
$a->setP1("new pp1");
foreach($a as $k=>$v){
    echo "key:".$k." - value:".$v.PHP_EOL;
}
$j = json_encode(array("hello"=>"world","echo"=>"what"));
$cj = json_decode($j);
foreach($cj as $k=>$v){
    echo "key:".$k." - value:".$v.PHP_EOL;
}
/**
 * 迭代类只能得出公开的属性
 */