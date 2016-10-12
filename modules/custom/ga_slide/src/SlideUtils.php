<?php
namespace Drupal\ga_slide;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class SlideUtils
{
    public static function getSlides()
    {
        $slideNids = \Drupal::entityQuery('slide')->sort('weight', 'ASC')->execute();
        $slideEntities = \Drupal::entityTypeManager()->getStorage("slide")->loadMultiple($slideNids);

        $slides = [];
        foreach ($slideEntities as $slideEntity) {
            $slides[] = array(
                "name" => $slideEntity->label(),
                "image" =>  ImageStyle::load('slide')->buildUrl(File::load($slideEntity->getImage()[0])->getFileUri()),
                "link" => $slideEntity->getLink()
            );
        }
        return $slides;
    }
}