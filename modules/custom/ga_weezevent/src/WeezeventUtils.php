<?php

namespace Drupal\ga_weezevent;

class WeezeventUtils {

  public static function getConfiguration() {
    $config = \Drupal::config('ga_weezevent.settings');

    $variables['title'] = $config->get('title');

    return $variables;
  }

  public static function getWeezeventdata() {
    $config = \Drupal::config('ga_weezevent.settings');
    $weezevent = new \Drupal\ga_weezevent\WeezeventAPI($config->get('api_key'), $config->get('access_token'), $config->get('id_event'));
    $tickets = $weezevent->tickets();

    $sum_participants = array();
    $sum_participants2 = array();
    $sum_quotas = array();
    $sum_revenu = array();
    $sum_revenu2 = array();
    $sum_revenu_quotas = array();
    foreach ($tickets->categories as $cat) {
      foreach ($cat->tickets as $ticket) {
        if (!isset($ticket->group_size)) {
          $ticket->group_size = 1;
        }
        $sum_quotas[$cat->name] += $ticket->quotas * $ticket->group_size;
        if ($ticket->quotas) {
          $ticket->remplissage = round(100 * ($ticket->participants / $ticket->group_size) / $ticket->quotas,2);
          $sum_participants[$cat->name] += (int) $ticket->participants;
          $sum_revenu[$cat->name] += ($ticket->price / $ticket->group_size) * $ticket->participants;
          $sum_revenu_quotas[$cat->name] += $ticket->price * $ticket->quotas;
        } else {
          $sum_participants2[$cat->name] += (int) $ticket->participants;
          $sum_revenu2[$cat->name] += (int) ($ticket->price / $ticket->group_size) * $ticket->participants;
        }
      }
      $cat->participants = $sum_participants[$cat->name] ?: 0;
      $cat->participants2 = $sum_participants2[$cat->name]?: 0;
      $cat->quotas = $sum_quotas[$cat->name];
      $cat->revenu = $sum_revenu[$cat->name] ?: 0;
      $cat->revenu2 = $sum_revenu2[$cat->name] ?: 0;
      $cat->revenu_quotas = $sum_revenu_quotas[$cat->name] ?: 0;

      if (preg_match("/^Tournois/",$cat->name)||preg_match("/^Overclocking/",$cat->name)) {
        $tickets->participants += $cat->participants;
        $tickets->quotas += $cat->quotas;
        $tickets->revenu_joueurs += $cat->revenu;
        $tickets->revenu_joueurs_quotas += $cat->revenu_quotas;
      }
      $tickets->participants2 += $cat->participants2;
      $tickets->revenu += $cat->revenu;
      $tickets->revenu2 += $cat->revenu2;
      $tickets->revenu_quotas += $cat->revenu_quotas;
    }
//var_dump($tickets);
    return $tickets;
  }
}
