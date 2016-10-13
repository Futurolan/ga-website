<?php

namespace Drupal\ga_front;

class FrontUtils
{

    public static function getPreliveConfiguration()
    {
        $config = \Drupal::config('ga_ticket.settings');


        $variables['edition_name'] = $config->get('edition_name');
        $variables['event_title'] = $config->get('event_title');
        $variables['event_text'] = $config->get('event_text');
        $variables['event_cta'] = $config->get('event_cta');
        $variables['planning_text'] = $config->get('planning_text');
        $variables['planning_cta'] = $config->get('planning_cta');
        $variables['ticket_text'] = $config->get('ticket_text');
        $variables['ticket_cta'] = $config->get('ticket_cta');

        return $variables;
    }
}
