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


      $tagsArray = [];
      foreach ($node->field_news_tags as $tag) {
        $tagsArray[] = \Drupal\taxonomy\Entity\Term::load($tag->target_id)
          ->getName();
      }

      //Set Image
      if ($node->field_news_image->entity) {
        $imageUri = $node->field_news_image->entity->getFileUri();
      }
      elseif ($node->field_news_tournament->entity && $node->field_news_tournament->entity->field_tournament_image->entity) {
        $imageUri = $node->field_news_tournament->entity->field_tournament_image->entity->getFileUri();
      }
      elseif ($node->field_news_game->entity) {
        $color = $node->field_news_game->entity->field_game_color->value;
        $gameName = $node->field_news_game->entity->getName();
        $imageUri = $node->field_news_game->entity->field_game_image->entity->getFileUri();
      }
      elseif ($node->field_news_edition->entity) {
        $imageUri = $node->field_news_edition->entity->field_edition_image->entity->getFileUri();
      }
      else {
        $imageUri = NewsUtils::getImageUri($node, "field_news_image");
      }

      //Set Subtitle
      if ($node->field_news_tournament->entity) {
        $subtitle = $node->field_news_tournament->entity->getTitle();
      }
      elseif ($node->field_news_game->entity) {
        $subtitle = $gameName;
      }
      elseif ($node->field_news_edition->entity) {
        $subtitle = $node->field_news_edition->entity->getName();
      }
      else {
        $subtitle = "Futurolan";
      }
      $style = \Drupal\image\Entity\ImageStyle::load("crop_news");

      $news[] = [
        "nid" => $node->id(),
        "title" => $node->getTitle(),
        "image" => $style->buildUrl($imageUri),
        "text" => $node->get("field_news_content")->getValue()[0]['summary'],
        "date" => $node->getCreatedTime(),
        "subtitle" => $subtitle,
        "color" => isset($color) ? $color : '#000000',
        "url" => $node->url(),
      ];
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

    return [
      "prev" => count($prevId) > 0 ? key($prevId) : NULL,
      "next" => count($nextId) > 0 ? key($nextId) : NULL,
    ];
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


  public static function getNewsCron() {

    $config = \Drupal::config('ga_config.settings');

    if ($config->get('external_news_url') !== '') {


      $client = \Drupal::httpClient();

      try {
        $response = $client->get($config->get('external_news_url'));

        $data = (string) $response->getBody();
        $jsonDatas = \GuzzleHttp\json_decode($data);

        foreach ($jsonDatas as $jsonData) {


          $ids = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('uuid', $jsonData->uuid)
            ->condition('type', 'news')
            ->execute();

          if (count($ids) > 0) {
            $node = Node::load(array_pop($ids));
            if (intval($jsonData->changed) != $node->getChangedTime()) {
              $node->set('title', stripslashes(htmlspecialchars_decode($jsonData->title, ENT_QUOTES)));
            }
            else {
              continue;
            }

          }
          else {
          var_export($jsonData->created);
          $node = Node::create([
            'type' => 'news',
            'title' => stripslashes(htmlspecialchars_decode($jsonData->title, ENT_QUOTES)),
          ]);

          $node->set('uuid', $jsonData->uuid);


        }

          $urlArray = parse_url($config->get('external_news_url'));


          $node->set('created', $jsonData->created);
          $node->set('changed', $jsonData->changed);
          $node->set('field_news_content', [
            'value' => $jsonData->field_news_content,
            'summary' => $jsonData->field_news_content_1,
          ]);

          if(strstr($jsonData->field_news_image,'default_images')==FALSE) {
            $data = file_get_contents($urlArray['scheme'] . '://' . $urlArray['host'] . $jsonData->field_news_image);
            $file = file_save_data($data, "public://" . basename($jsonData->field_news_image), FILE_EXISTS_REPLACE);


            $node->set('field_news_image', [
              'target_id' => $file->id(),
            ]);
          }

          $node->set('field_news_show_image', $jsonData->field_news_show_image);
          $node->set('field_news_edition', [['target_id' => $jsonData->field_news_edition]]);
          $node->save();


        }


      }
  catch
    (RequestException $e) {
      watchdog_exception('ga_news', $e);
    } catch (\InvalidArgumentException $e) {
      watchdog_exception('ga_news', $e);
    }
    }
}

}

