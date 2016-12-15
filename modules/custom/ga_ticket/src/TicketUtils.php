<?php

namespace Drupal\ga_ticket;

class TicketUtils {

  public static function getConfiguration() {
    $config = \Drupal::config('ga_ticket.settings');

    $variables['title'] = $config->get('title');
    $variables['weezevent_code'] = $config->get('weezevent_code');

    return $variables;
  }
}
