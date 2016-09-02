<?php

/**
 * @file
 * Contains \Drupal\ga_front\Controller\FrontLiveController.
 */

namespace Drupal\ga_front\Controller;

use Drupal\Core\Controller\ControllerBase;


class FrontLiveController extends ControllerBase
{

    public function render()
    {


        $streamNids = \Drupal::entityQuery('stream')->sort('weight', 'ASC')->execute();
        $streamEntities = \Drupal::entityTypeManager()->getStorage("stream")->loadMultiple($streamNids);

        $streams = [];
        foreach ($streamEntities as $streamEntity) {
            $streams[] = array(
                "name" => $streamEntity->label(),
                "type" => $streamEntity->getType(),
                "key" => $streamEntity->getKey(),
            );
        }
        return array(
            '#theme' => "ga_front_live",
            '#streams' => $streams,
        );

    }

}