<?php

include "woo/domain/DomainObject.php";
include "woo/mapper/Mapper.php";
include "woo/mapper/VenueMapper.php";
include "woo/base/Registry.php";
include "woo/base/AppException.php";
include "woo/base/ApplicationRegistry.php";

$mapper = new \woo\mapper\VenueMapper();
$venue = $mapper->find(12);
print_r($venue);