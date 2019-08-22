<?php
namespace woo\mapper;

use woo\domain\DomainObject;
use woo\domain\Venue;

class VenueMapper extends Mapper
{
    public function __construct(\PDO $pdo)
    {
        parent::__construct($pdo);
        $this->selectStmt = self::$PDO->prepare("select * from venue where id=?");
        $this->updateStmt = self::$PDO->prepare("update venue set name=?, id=? where id=?");
        $this->insertStmt = self::$PDO->prepare("insert into venue (name) values (?)");
    }

    function getCollection(array $raw){
       return new SpaceCollection($raw,$this);
    }


    protected function doCreateObject(array $array)
    {
        $obj = new Venue($array['id']);
        $obj->setName($array['name']);
        return $obj;
    }

    protected function doInsert(DomainObject $object)
    {
        print "Вставка\n";
        debug_print_backtrace();
        $values = [$object->getName()];
        $this->insertStmt->execute($values);
        $id = self::$PDO->lastInsertId();
        $object->setId($id);
    }

    function update(DomainObject $object)
    {
        print "Обновление\n";
        $values = [$object->getName(),$object->getId(),$object->getId()];
        $this->updateStmt->execute($values);
    }
    function selectStmt(){
        return $this->selectStmt;
    }

    protected function doSelectStmt()
    {
        // TODO: Implement doSelectStmt() method.
    }
}