<?php
namespace woo\process;


class VenueManager extends Base
{
    static $add_venue = "INSERT INTO venue (name) values (?)";
    static $add_space = "INSERT INTO space (name,venue) valuse (?,?)";
    static $check_clot = "SELECT id, name FROM event Where space = ? AND (start+duration) > ? AND start < ?";
    static $add_event = "INSERT INTO event (name, space, start, duration) values (?,?,?,?)";

    function addVenue ($name,$space_array){

    }
    function bookEvent(){

    }
}