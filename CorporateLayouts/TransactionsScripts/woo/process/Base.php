<?php
namespace woo\process;

abstract class Base
{
    static $DB;
    static $statements = [];

    public function __construct()
    {
        $dsn = \woo\base\ApplicationRegistry::getDSN();
        if (is_null($dsn)){
            throw new \woo\base\AppException('DSN не определен.');
        }
        self::$DB = new \PDO($dsn);
        self::$DB->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    function prepareStatement($statement){
       if (isset(self::$statements[$statement])){
           return self::$statements[$statement];
       }
       $stml_handle = self::$DB->prepare($statement);
       self::$statements[$statement] = $stml_handle;
       return $stml_handle;
    }
    public function doStatement($statement, array $values){
       $sth = $this->prepareStatement($statement);
       $sth->closeCursor();
       $db_result = $sth->execute($values);
       return $sth;
    }
}