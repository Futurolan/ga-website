<?php

namespace Drupal\ga_slide\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Slide entities.
 */
interface SlideInterface extends ConfigEntityInterface {

  public function getImage();

  public function setImage($image);

  public function getLink();

  public function setLink($link);

  public function getVideo();

  public function setVideo($image);

}
