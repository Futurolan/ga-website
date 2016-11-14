<?php

namespace Drupal\ga_visitors\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_visitors\VisitorsUtils;

class VisitorsController extends ControllerBase {
  public function render() {
    $config = VisitorsUtils::getConfiguration();
    return array(
      '#theme' => "ga_visitors",
      '#config' => $config
    );
  }

}