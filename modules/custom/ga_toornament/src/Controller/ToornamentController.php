<?php

namespace Drupal\ga_toornament\Controller;

use Drupal\Core\Controller\ControllerBase;

class ToornamentController extends ControllerBase {
  public function render() {
    \Drupal::logger('ga_toornament')->error('blabla');
    return array(
      '#theme' => "ga_toornament",
      '#cache' => array('max-age' => 60)
    );
  }

}
