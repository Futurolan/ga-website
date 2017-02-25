<?php

namespace Drupal\ga_schedule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_schedule\ScheduleUtils;

class ScheduleController extends ControllerBase {
  public function render() {
    $config = ScheduleUtils::getConfiguration();
    $activities = ScheduleUtils::getActivities();
    return array(
      '#theme' => "ga_schedule",
      '#config' => $config,
      '#activities' => $activities,
      '#cache' => array('max-age' => 60)
    );
  }

  public function getTitle() {
    $config = \Drupal::config('ga_schedule.settings');
    return $config->get('title');
  }

}