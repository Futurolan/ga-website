<?php
namespace Drupal\ga_slide;

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
                "image" => $slideEntity->getImage(),
                "link" => $slideEntity->getLink()
            );
        }
        return $slides;
    }
}