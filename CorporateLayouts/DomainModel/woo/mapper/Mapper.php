<?php
namespace woo\mapper;
use woo\base\AppException;
use woo\base\ApplicationRegistry;
use woo\domain\DomainObject;

abstract class Mapper
{
    protected static $PDO;
    public function __construct(\PDO $pdo)
    {
            $this->pdo = $pdo;
    }
    function find($id){
        $this->selectStmt()->execute([$id]);
        $array = $this->selectStmt()->fetch();
        $this->selectStmt()->closeCursor();
        if (!isset($array['id']) || !is_array($array)){return null;}
        return $this->createObject($array);
    }
    function crateObject($array){
        return $this->doCreateObject($array);
    }
    function insert(DomainObject $obj){
       $this->doInsert($obj);
    }
    abstract function update(DomainObject $object);
    protected abstract function doCreateObject(array $array);
    protected abstract function doInsert(DomainObject $object);
    protected abstract function doSelectStmt();
}