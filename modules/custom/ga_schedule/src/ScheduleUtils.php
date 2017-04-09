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

  public static function getActivities() {

    $langcode = \Drupal::languageManager()
      ->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)
      ->getId();

    $activityNids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'activity')
      ->condition('langcode', $langcode)
      ->sort('field_date', 'ASC')
      ->execute();

    $activities = [];

    foreach ($activityNids as $nid) {


      $node = Node::load($nid);

      $node = \Drupal::entityManager()
        ->getTranslationFromContext($node, $langcode);

      $date = date('m/d/Y', strtotime($node->field_date->getValue()[0]['value']));

      $activities[$date][] = $node;
    }

    ksort($activities);
    return $activities;

  }

  public static function getGames() {

    $games = [];

    $gameTerms = \Drupal::service('entity_type.manager')
      ->getStorage("taxonomy_term")
      ->loadTree('game', $parent = 0, $max_depth = NULL, $load_entities = FALSE);
    foreach ($gameTerms as $game) {
      $g = [];
      $g['name'] = \Drupal::entityTypeManager()
        ->getStorage('taxonomy_term')
        ->load($game->tid)
        ->get('field_game_short_name')
        ->getValue()[0]['value'];
      $g['tid'] = $game->tid;
      $games[$game->weight] = $g;
    }
    ksort($games);
    return array_slice($games, 0, 8);

  }

  public static function getNextActivities() {
    $langcode = \Drupal::languageManager()
      ->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)
      ->getId();

    $activityNids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'activity')
      ->condition('langcode', $langcode)
      ->range(0, 5)
      ->condition('field_date', date('c'), '>')
      ->sort('field_date', 'ASC')
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
