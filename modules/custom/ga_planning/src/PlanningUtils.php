<?php

namespace Drupal\ga_planning;

class PlanningUtils {

  public static function getConfiguration() {
    $config = \Drupal::config('ga_planning.settings');

    $variables['title'] = $config->get('title');

    return $variables;
  }
}
