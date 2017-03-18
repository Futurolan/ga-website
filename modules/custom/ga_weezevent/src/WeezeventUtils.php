<?php

namespace Drupal\ga_weezevent;

class WeezeventUtils {

  public static function getConfiguration() {
    $config = \Drupal::config('ga_weezevent.settings');

    $variables['title'] = $config->get('title');

    return $variables;
  }

  public static function getWeezeventdata() {
    $config = \Drupal::config('ga_weezevent.settings');
    $weezevent = new \Drupal\ga_weezevent\WeezeventAPI($config->get('api_key'), $config->get('access_token'), $config->get('id_event'));

    $tickets = $weezevent->tickets();    
    return $tickets;

  }
}
