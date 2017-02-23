<?php

namespace Drupal\ga_sponsor\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Sponsor level entities.
 */
interface SponsorLevelInterface extends ConfigEntityInterface {

  // Add get/set methods for your configuration properties here.

  public function getDisplayFront();

  public function setDisplayFront($display);

}
