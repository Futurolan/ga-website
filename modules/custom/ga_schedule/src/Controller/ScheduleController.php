<?php

namespace Drupal\ga_schedule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_schedule\ScheduleUtils;

class ScheduleController extends ControllerBase {
  public function render() {
    $config = ScheduleUtils::getConfiguration();
    return array(
      '#theme' => "ga_schedule",
      '#config' => $config
    );
  }

  public function getTitle() {
    $config = \Drupal::config('ga_schedule.settings');
    return $config->get('title');
  }

}