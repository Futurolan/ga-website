<?php

namespace Drupal\ga_visitors;

class VisitorsUtils {

  public static function getConfiguration() {
    $config = \Drupal::config('ga_visitors.settings');


    $variables['show_ticketing'] = $config->get('show_ticketing');
    $variables['title'] = $config->get('title');
    $variables['description'] = $config->get('description');
    $variables['map_api_key'] = $config->get('map_api_key');
    $variables['map_place_id'] = $config->get('map_place_id');
    $variables['planning_text'] = $config->get('planning_text');
    $variables['price_text'] = $config->get('price_text');
    $variables['access_text'] = $config->get('access_text');
    $variables['accommodation_text'] = $config->get('accommodation_text');
    $variables['equipment_text'] = $config->get('equipment_text');
    $variables['food_service_text'] = $config->get('food_service_text');

    return $variables;
  }
}
