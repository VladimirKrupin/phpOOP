<?php
namespace woo\domain;

abstract class DomainObject
{
    private $id;
    public function __construct($id=null)
    {
        $this->id = $id;
    }
    function getId(){
        return $this->id;
    }
    static function getCollection($type){
        return [];
    }
    function collection(){
       return self::getCollection(get_class($this));
    }
}

class Venue extends DomainObject{
    private $name;
    private $spaces;

    public function __construct($id = null,$name=null)
    {
        $this->name = $name;
        $this->spaces = self::getCollection("\\woo\\domain\\Space");
        parent::__construct($id);
    }

    /**
     * @return array
     */
    public function getSpaces()
    {
        return $this->spaces;
    }
    /**
     * @param array $spaces
     */
    public function setSpaces(SpaceCollection $spaces)
    {
        $this->spaces = $spaces;
    }

    function addSpace(Space $space){
        $this->spaces->add($space);
        $space->setVenue($this);
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param null $name
     */
    public function setName($name_s)
    {
        $this->name = $name_s;
        $this->markDirty();
    }
}