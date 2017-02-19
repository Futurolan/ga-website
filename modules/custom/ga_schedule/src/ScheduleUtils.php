<?php

namespace Drupal\ga_schedule;

class ScheduleUtils {

  public static function getConfiguration() {
    $config = \Drupal::config('ga_schedule.settings');


    $variables['title'] = $config->get('title');


    return $variables;
  }
}
