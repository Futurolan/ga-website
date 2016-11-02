<?php

namespace Drupal\ga_game\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Game entities.
 */
interface GameInterface extends ConfigEntityInterface
{

    // Add get/set methods for your configuration properties here.

    public function getDescription();

    public function setDescription($description);

    public function getColor();

    public function setColor($color);

    public function getShortName();

    public function setShortName($shortName);

    public function getEditor();

    public function setEditor($editor);

    public function getType();

    public function setType($type);

    public function getImage();
    public function getImageUri();

    public function setImage($image);
}
