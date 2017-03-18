<?php

namespace Drupal\ga_weezevent\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_weezevent\WeezeventAPI;
use Drupal\ga_weezevent\WeezeventUtils;

class WeezeventController extends ControllerBase {
  public function render() {
    $config = WeezeventUtils::getConfiguration();
    $weezevent_data = WeezeventUtils::getWeezeventdata();
    return array(
      '#theme' => "ga_weezevent",
      '#config' => $config,
      '#weezdata' => $weezevent_data,
      '#cache' => array('max-age' => 60)
    );
  }
  public function getTitle() {
    $config = \Drupal::config('ga_weezevent.settings');
    return $config->get('title');
  }

}
