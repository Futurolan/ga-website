<?php
namespace Drupal\ga_family;

use Drupal\Core\Language\LanguageInterface;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;

class FamilyUtils {

  public static function getFamilies() {
    $familyNids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'family')
      ->sort('field_family_weight')
      ->execute();

    $families = [];

    $langcode = \Drupal::languageManager()
      ->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)
      ->getId();
    foreach ($familyNids as $nid) {
      $node = Node::load($nid);
      $node = \Drupal::entityManager()
        ->getTranslationFromContext($node, $langcode);

      $familyLevelEntity = \Drupal::entityTypeManager()
        ->getStorage("family_level")
        ->load($node->field_family_level->target_id);
      if (!isset($families[$familyLevelEntity->weight])) {
        $families[$familyLevelEntity->weight] = array(
          "title" => $familyLevelEntity->label(),
          "families" => [],
          "displayFront" => $familyLevelEntity->getDisplayFront()
        );
      }

      $families[$familyLevelEntity->weight]["families"][] = array(
        "title" => $node->getTitle(),
        "url" => $node->field_family_url->value,
        "image" => ImageStyle::load('family_front')
          ->buildUrl($node->get("field_family_image")->entity->uri->value)
      );
    }

    ksort($families);
    return $families;
  }

  public static function getConfiguration() {
    $config = \Drupal::config('ga_family.settings');

    $variables['title'] = $config->get('title');
    return $variables;
  }
}