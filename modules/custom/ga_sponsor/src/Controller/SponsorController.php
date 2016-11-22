<?php

namespace Drupal\ga_sponsor\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_sponsor\SponsorUtils;

class SponsorController extends ControllerBase {
  public function render() {
    $config = SponsorUtils::getConfiguration();
    $sponsors = SponsorUtils::getSponsors();
    return array(
      '#theme' => "ga_sponsor",
      '#config' => $config,
      '#sponsors' => $sponsors
    );
  }
  public function getTitle() {
    $config = \Drupal::config('ga_sponsor.settings');
    return $config->get('title');
  }


}