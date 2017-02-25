<?php

namespace Drupal\ga_visitors\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_visitors\VisitorsUtils;

class VisitorsController extends ControllerBase {
  public function render() {
    $config = VisitorsUtils::getConfiguration();
    return array(
      '#theme' => "ga_visitors",
      '#config' => $config,
      '#cache' => array('max-age' => 60)
    );
  }

  public function getTitle() {
    $config = \Drupal::config('ga_visitors.settings');
    return $config->get('title');
  }

}