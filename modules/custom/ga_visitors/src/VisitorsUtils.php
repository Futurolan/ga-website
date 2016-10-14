<?php

namespace Drupal\ga_visitors;

class VisitorsUtils
{

    public static function getConfiguration()
    {
        $config = \Drupal::config('ga_visitors.settings');

        $variables['title'] = $config->get('title');

        return $variables;
    }
}
