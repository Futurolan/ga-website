<?php

namespace Drupal\ga_front;

use Drupal\file\Entity\File;

class FrontUtils {

  public static function getPreliveConfiguration() {
    $config = \Drupal::config('ga_front.prelive.settings');

    $variables['edition_name'] = $config->get('edition_name');
    $variables['slide_time'] = $config->get('slide_time');
    $variables['b1_reverse'] = $config->get('b1_reverse');
    $variables['b1_title'] = $config->get('b1_title');
    $variables['b1_text'] = $config->get('b1_text');
    $variables['b1_cta'] = $config->get('b1_cta');
    $variables['b1_link'] = $config->get('b1_link');
    $variables['b1_image'] = isset($config->get('b1_image')[0]) ? File::load($config->get('b1_image')[0])
      ->getFileUri() : NULL;
    $variables['b2_reverse'] = $config->get('b2_reverse');
    $variables['b2_title'] = $config->get('b2_title');
    $variables['b2_text'] = $config->get('b2_text');
    $variables['b2_cta'] = $config->get('b2_cta');
    $variables['b2_link'] = $config->get('b2_link');
    $variables['b2_image'] = isset($config->get('b2_image')[0]) ? File::load($config->get('b2_image')[0])
      ->getFileUri() : NULL;
    $variables['b3_reverse'] = $config->get('b3_reverse');
    $variables['b3_title'] = $config->get('b3_title');
    $variables['b3_text'] = $config->get('b3_text');
    $variables['b3_cta'] = $config->get('b3_cta');
    $variables['b3_link'] = $config->get('b3_link');
    $variables['b3_image'] = isset($config->get('b3_image')[0]) ? File::load($config->get('b3_image')[0])
      ->getFileUri() : NULL;
    $variables['show_sponsors'] = $config->get('show_sponsors');


    return $variables;
  }

  public static function getLiveConfiguration() {
    $config = \Drupal::config('ga_front.prelive.settings');
    $variables['show_sponsors'] = $config->get('show_sponsors');
    return $variables;
  }
}
