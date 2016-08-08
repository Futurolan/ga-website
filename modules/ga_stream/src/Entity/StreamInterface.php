<?php

namespace Drupal\ga_stream\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Stream entities.
 */
interface StreamInterface extends ConfigEntityInterface {

    public function getKey();
    public function getType();
    public function setKey($key);
    public function setType($type);
}
