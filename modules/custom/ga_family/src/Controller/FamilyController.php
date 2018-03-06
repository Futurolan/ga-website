<?php

namespace Drupal\ga_family\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_family\FamilyUtils;

class FamilyController extends ControllerBase {
  public function render() {
    $config = FamilyUtils::getConfiguration();
    $families = FamilyUtils::getFamilies();
    return array(
      '#theme' => "ga_family",
      '#config' => $config,
      '#families' => $families,
      '#cache' => array('max-age' => 60)
    );
  }
  public function getTitle() {
    $config = \Drupal::config('ga_family.settings');
    return $config->get('title');
  }


}