<?php

namespace Drupal\ga_gamers\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_gamers\GamersUtils;

class GamersController extends ControllerBase
{
    public function render()
    {
        $config = GamersUtils::getConfiguration();
        return array(
            '#theme' => "ga_gamers",
            '#config' => $config
        );
    }

}