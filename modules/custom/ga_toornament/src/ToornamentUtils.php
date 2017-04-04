<?php

namespace Drupal\ga_toornament;

use Drupal\node\Entity\Node;

class ToornamentUtils {

  public static function getLastMatch() {
    $config = \Drupal::config('ga_toornament.settings');

    $lastMatch = [];
    $toornament = new \Drupal\ga_toornament\ToornamentAPI($config->get('api_key'));

    //Get all tournament with toornament enable
    $tournamentsNids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('field_tournament_show_toornament',true)
      ->condition('type', 'tournament')
      ->execute();

    foreach ($tournamentsNids as $nid) {
      $node = Node::load($nid);
      if($node->get('field_tournament_show_toornament')->value){
        $toornament_id = $node->get('field_tournament_toornament_id')->value;
        $lastMatchResult = $toornament->getLastMatch($toornament_id);
        //var_dump($lastMatchResult[0]->opponents[1]->participant->name);
        //$lastMatcharray_chunk($lastMatchResult,5)[0]



      }
    }
    $sponsors = [];


    //


    return $lastMatch;
  }


}
