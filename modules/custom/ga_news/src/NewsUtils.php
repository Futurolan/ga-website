<?php
namespace Drupal\ga_news;

use Drupal\Core\Language\LanguageInterface;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;

class NewsUtils {
  public static function getLastNews() {

    $langcode = \Drupal::languageManager()
      ->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)
      ->getId();

    $newsNids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'news')
      ->condition('langcode', $langcode)
      ->sort('created', 'DESC')
      ->range(0, 3)
      ->execute();

    $news = [];

    foreach ($newsNids as $nid) {


      $node = Node::load($nid);

      $node = \Drupal::entityManager()
        ->getTranslationFromContext($node, $langcode);


      $tagsArray = array();
      foreach ($node->field_news_tags as $tag) {
        $tagsArray[] = \Drupal\taxonomy\Entity\Term::load($tag->target_id)
          ->getName();
      }

      $gameId = $node->field_game->target_id;
      $color = NULL;
      $gameShortName = NULL;
      $gameImage = NULL;
      $gameImageUri = NULL;
      if ($gameId) {
        $game = \Drupal::entityTypeManager()->getStorage("game")->load($gameId);
        $color = $game->getColor();
        $gameShortName = $game->getShortName();
        $gameImageUri = $game->getImageUri();
      }

      if ($node->field_news_image->entity) {
        $imageUri = $node->field_news_image->entity->getFileUri();
      }
      elseif ($gameImageUri) {
        $imageUri = $gameImageUri;
      }
      elseif ($node->field_news_tournament->entity) {
        $imageUri = $node->field_news_tournament->entity->field_tournament_image->entity->getFileUri();
      }
      else {
        $imageUri = NewsUtils::getImageUri($node, "field_news_image");
      }


      $news[] = array(
        "nid" => $node->id(),
        "title" => $node->getTitle(),
        "image" => ImageStyle::load('news_front')->buildUrl($imageUri),
        "text" => $node->get("field_news_content")->getValue()[0]['summary'],
        "date" => $node->getCreatedTime(),
        "tags" => $tagsArray,
        "gameShortName" => $gameShortName,
        "color" => $color,
        "url" => $node->url()
      );
    }
    return $news;
  }

  public static function getNextPrevIds($created) {

    $nextId = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('created', $created, '<')
      ->condition('langcode', \Drupal::languageManager()
        ->getCurrentLanguage()
        ->getId())
      ->condition('type', 'news')
      ->sort('created', 'DESC')
      ->range(0, 1)
      ->execute();

    $prevId = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('created', $created, '>')
      ->condition('langcode', \Drupal::languageManager()
        ->getCurrentLanguage()
        ->getId())
      ->condition('type', 'news')
      ->sort('created', 'ASC')
      ->range(0, 1)
      ->execute();

    return array(
      "prev" => count($prevId) > 0 ? key($prevId) : NULL,
      "next" => count($nextId) > 0 ? key($nextId) : NULL
    );
  }

  public static function getImageUri($entity, $fieldName) {
    $image_uri = NULL;
    if ($entity->hasField($fieldName)) {
      try {
        $field = $entity->{$fieldName}; //Try loading from field values first.
        if ($field && $field->target_id) {
          $file = File::load($field->target_id);
          if ($file) {
            $image_uri = $file->getFileUri();
          }
        }
      } catch (\Exception $e) {
        \Drupal::logger('get_image_uri')->notice($e->getMessage(), []);
      }

      // If a set value above wasn't found, try the default image.
      if (is_null($image_uri)) {
        try {
          $field = $entity->get($fieldName); // Loading from field definition
          if ($field) {
            // From the image module /core/modules/image/ImageFormatterBase.php
            // $default_image = $test->fieldDefinition->getFieldStorageDefinition()->getSetting('default_image');
            $default_image = $field->getSetting('default_image');
            if ($default_image && $default_image['uuid']) {
              // $defaultImageFile = \Drupal::entityManager()->loadEntityByUuid('file', $default_image['uuid']));
              // See https://www.drupal.org/node/2549139  entityManager is deprecated.
              // Use entity.repository instead.
              $entityrepository = \Drupal::service('entity.repository');
              $defaultImageFile = $entityrepository->loadEntityByUuid('file', $default_image['uuid']);
              if ($defaultImageFile) {
                $image_uri = $defaultImageFile->getFileUri();
              }
            }
          }
        } catch (\Exception $e) {
          \Drupal::logger('NewsUtils')->notice($e->getMessage(), []);
        }
      }
    }

    return $image_uri;
  }
}