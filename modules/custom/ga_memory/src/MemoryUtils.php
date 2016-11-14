<?php

namespace Drupal\ga_memory;

use Drupal\Core\Language\LanguageInterface;
use Drupal\node\Entity\Node;

class MemoryUtils {

  public static function getConfiguration() {
    $config = \Drupal::config('ga_memory.settings');

    $variables['title'] = $config->get('title');

    return $variables;
  }

  public static function getMemories() {

    $sponsorNids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'memory')
      ->sort('field_memory_weight')
      ->execute();

    $memories = [];

    $langcode = \Drupal::languageManager()
      ->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)
      ->getId();
    foreach ($sponsorNids as $nid) {
      $node = Node::load($nid);
      $node = \Drupal::entityManager()
        ->getTranslationFromContext($node, $langcode);
      $memories[] = $node;

    }
    return $memories;
  }
}
