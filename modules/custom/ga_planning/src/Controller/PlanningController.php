<?php

namespace Drupal\ga_planning\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_planning\PlanningUtils;

class PlanningController extends ControllerBase {
  public function render() {
    $config = PlanningUtils::getConfiguration();
    return array(
      '#theme' => "ga_planning",
      '#config' => $config
    );
  }

}