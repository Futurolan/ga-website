<?php

namespace Drupal\ga_family\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Family level entities.
 */
interface FamilyLevelInterface extends ConfigEntityInterface {

  // Add get/set methods for your configuration properties here.

  public function getDisplayFront();

  public function setDisplayFront($display);

}
