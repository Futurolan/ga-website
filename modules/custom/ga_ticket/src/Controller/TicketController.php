<?php

namespace Drupal\ga_ticket\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_ticket\TicketUtils;

class TicketController extends ControllerBase {
  public function render() {
    $config = TicketUtils::getConfiguration();
    return array(
      '#theme' => "ga_ticket",
      '#config' => $config
    );
  }

}