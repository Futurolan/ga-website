<?php
namespace Drupal\ga_sponsor;

use Drupal\Core\Language\LanguageInterface;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;

class SponsorUtils {
  public static function getFrontSponsors() {
    $langcode = \Drupal::languageManager()
      ->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)
      ->getId();

    $sponsorNids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'sponsor')
      ->sort('field_sponsor_weight')
      ->execute();

    $sponsors = [];

    foreach ($sponsorNids as $nid) {

      $node = Node::load($nid);
      $node = \Drupal::entityManager()
        ->getTranslationFromContext($node, $langcode);

      $sponsors[] = array(
        "title" => $node->getTitle(),
        "image" => ImageStyle::load('sponsor_front')
          ->buildUri($node->get("field_sponsor_image")->entity->uri->value)
      );
    }

    return $sponsors;
  }

  public static function getSponsors() {
    $sponsorNids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'sponsor')
      ->sort('field_sponsor_weight')
      ->execute();

    $sponsors = [];

    $langcode = \Drupal::languageManager()
      ->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)
      ->getId();
    foreach ($sponsorNids as $nid) {
      $node = Node::load($nid);
      $node = \Drupal::entityManager()
        ->getTranslationFromContext($node, $langcode);

      $sponsorLevelEntity = \Drupal::entityTypeManager()
        ->getStorage("sponsor_level")
        ->load($node->field_sponsor_level->target_id);
      if (!isset($sponsors[$sponsorLevelEntity->weight])) {
        $sponsors[$sponsorLevelEntity->weight] = array(
          "title" => $sponsorLevelEntity->label(),
          "sponsors" => []
        );
      }
      $sponsors[$sponsorLevelEntity->weight]["sponsors"][] = array(
        "title" => $node->getTitle(),
        "url" => $node->field_sponsor_url->value,
        "image" => ImageStyle::load('sponsor_front')
          ->buildUrl($node->get("field_sponsor_image")->entity->uri->value)
      );
    }
    ksort($sponsors);
    return $sponsors;
  }

  public static function getConfiguration() {
    $config = \Drupal::config('ga_sponsor.settings');

    $variables['title'] = $config->get('title');
    return $variables;
  }
}