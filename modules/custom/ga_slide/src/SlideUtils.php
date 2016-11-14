<?php
namespace Drupal\ga_slide;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class SlideUtils {
  public static function getSlides() {
    $slideNids = \Drupal::entityQuery('slide')
      ->sort('weight', 'ASC')
      ->execute();
    $slideEntities = \Drupal::entityTypeManager()
      ->getStorage("slide")
      ->loadMultiple($slideNids);


    $slides = [];
    foreach ($slideEntities as $slideEntity) {
      $slides[] = array(
        "name" => $slideEntity->label(),
        "image" => isset($slideEntity->getImage()[0]) && File::load($slideEntity->getImage()[0]) ? ImageStyle::load('slide')
          ->buildUrl(File::load($slideEntity->getImage()[0])
            ->getFileUri()) : NULL,
        "video" => isset($slideEntity->getVideo()[0]) && File::load($slideEntity->getVideo()[0]) ? File::load($slideEntity->getVideo()[0])
          ->getFileUri() : NULL,
        "link" => $slideEntity->getLink()
      );
    }
    return $slides;
  }
}