<?php

namespace Drupal\ga_planning\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_planning\PlanningUtils;

class PlanningController extends ControllerBase {
  public function render() {
    $config = PlanningUtils::getConfiguration();
    return array(
      '#theme' => "ga_planning",
      '#config' => $config,
      '#cache' => array('max-age' => 60)
    );
  }
  public function getTitle() {
    $config = \Drupal::config('ga_planning.settings');
    return $config->get('title');
  }

}