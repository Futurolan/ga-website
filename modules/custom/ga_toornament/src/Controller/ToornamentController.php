<?php

namespace Drupal\ga_toornament\Controller;

use Drupal\ga_toornament\ToornamentUtils;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class ToornamentController extends ControllerBase {
  public function render() {
    return array(
      '#theme' => "ga_toornament",
      '#cache' => array('max-age' => 60)
    );
  }

  public function nextid($id) {
    $response = new Response();
    $response->setContent(ToornamentUtils::getNextId($id));
    return $response;
  }


}
