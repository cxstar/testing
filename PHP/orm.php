<?php
/**
 * File       : orm.php
 * Time       : 14-8-18 下午8:43
 * Author     : star
 * Description: __call 调用类内部不存在的类方法，__callStatic 在静态内部调用不存在的方法。
 */
abstract class ActiveRecord{
    protected static $table;
    protected $fieldvalues;
    public $select;

    static function findById($id){
        $query = "select * from ".static::$table." where id = $id";
        return self::createDomain($query);
    }

    function __get($fieldname){
        return $this->fieldvalues[$fieldname];
    }

    static function __callStatic($method,$args){
        $field = preg_replace("/^findBy(\w*)$/","$1",$method);
        $query = "select * from ".static::$table." where $field = '${args[0]}'";
        return self::createDomain($query);
    }

    private static function createDomain($query){
        $class = get_called_class();
        $domain = new $class();
        $domain->fieldvalues = array();
        $domain->select = $query;
        foreach($class::$fields as $field=>$type){
            $domain->fieldvalues[$field] = 'TODO:set from sql result';
        }
        return $domain;
    }
}

class Customer extends ActiveRecord{
    protected static $table = 'custdb';
    protected static $fields = array(
        'id'    =>  'int',
        'email' =>  'varchar',
        'lastname'  =>  'varchar'
    );

}

class Sales extends ActiveRecord{
    protected static $table = 'salesdb';
    protected static $fields = array(
        'id'    =>  'int',
        'item'  =>  'varchar',
        'qty'   =>  'int'
    );
}

assert("select * from custdb where id = 123" == Customer::findById(123)->select);