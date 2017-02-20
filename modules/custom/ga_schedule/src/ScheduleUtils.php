<?php

namespace Drupal\ga_schedule;

use Drupal\Core\Language\LanguageInterface;
use Drupal\node\Entity\Node;

class ScheduleUtils {

  public static function getConfiguration() {
    $config = \Drupal::config('ga_schedule.settings');


    $variables['title'] = $config->get('title');


    return $variables;
  }

  public static function getActivities(){

    $langcode = \Drupal::languageManager()
      ->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)
      ->getId();

    $activityNids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'activity')
      ->condition('langcode', $langcode)
      ->sort('created', 'DESC')
      ->execute();

    $activities = [];

    foreach ($activityNids as $nid) {


      $node = Node::load($nid);

      $node = \Drupal::entityManager()
        ->getTranslationFromContext($node, $langcode);

      $activities[] = $node;
    }


    return $activities;

  }
}
