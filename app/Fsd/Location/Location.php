<?php 
namespace Fsd\Location;

use Fsd\Core\Entity;

class Location extends Entity {
   protected $primaryKey = 'loc_id';
   public $timestamps    = false;
}