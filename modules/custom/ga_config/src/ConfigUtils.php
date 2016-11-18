<?php

namespace Drupal\ga_config;

use Drupal\file\Entity\File;

class ConfigUtils {

  public static function getConfiguration() {
    $config = \Drupal::config('ga_config.settings');

    $variables['facebook_url'] = $config->get('facebook_url');
    $variables['twitter_url'] = $config->get('twitter_url');
    $variables['flickr_url'] = $config->get('flickr_url');
    $variables['twitch_url'] = $config->get('twitch_url');
    $variables['youtube_url'] = $config->get('youtube_url');
    $variables['main_sponsor_url'] = $config->get('main_sponsor_url');

    $variables['main_sponsor_image'] = isset($config->get('main_sponsor_image')[0]) ? File::load($config->get('main_sponsor_image')[0])
      ->getFileUri() : NULL;

    return $variables;
  }
}
