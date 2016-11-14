<?php
namespace Drupal\ga_stream;

class StreamUtils {
  public static function getStreams() {
    $streamNids = \Drupal::entityQuery('stream')
      ->sort('weight', 'ASC')
      ->execute();
    $streamEntities = \Drupal::entityTypeManager()
      ->getStorage("stream")
      ->loadMultiple($streamNids);

    $streams = [];
    foreach ($streamEntities as $streamEntity) {
      $streams[] = array(
        "name" => $streamEntity->label(),
        "type" => $streamEntity->getType(),
        "key" => $streamEntity->getKey(),
      );
    }
    return $streams;
  }
}