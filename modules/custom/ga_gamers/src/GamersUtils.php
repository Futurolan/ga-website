<?php

namespace Drupal\ga_gamers;

class GamersUtils {

  public static function getConfiguration() {
    $config = \Drupal::config('ga_gamers.settings');

    $variables['title'] = $config->get('title');

    return $variables;
  }
}
