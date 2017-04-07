<?php

namespace Drupal\ga_toornament;

use Drupal\node\Entity\Node;

class ToornamentUtils {

  public static function getNextId($id) {
    $next=0;
    $first_id=0;
    $toornamentsNids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'tournament')
      ->exists('field_tournament_toornament_id')
//      ->condition('field_tournament_show_toornament',true)
      ->sort('field_tournament_weight')
      ->execute();
    foreach ($toornamentsNids as $nid) {
      $node = Node::load($nid);
      if (!$first_id) {
        $first_id=$node->get('field_tournament_toornament_id')->value;
      }
      if ($next) {
        return ($node->get('field_tournament_toornament_id')->value);
      }
      if ($node->get('field_tournament_toornament_id')->value == $id) {
        $next = 1;
      }
    }
    return $first_id;
  }

  public static function getResults() {

    $results = [];
    $resultIds = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'toornament_result')
      ->range(0, 5)
      ->sort('created')
      ->execute();

    foreach ($resultIds as $resultId){
      $results[] = Node::load($resultId);
    }
    return $results;
  }

  public static function updateMatch() {

    $config = \Drupal::config('ga_toornament.settings');

    $toornament = new \Drupal\ga_toornament\ToornamentAPI($config->get('api_key'));

    //Get all tournament with toornament enable
    $tournamentsNids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('field_tournament_show_toornament', TRUE)
      ->condition('type', 'tournament')
      ->execute();

    foreach ($tournamentsNids as $nid) {
      $node = Node::load($nid);
      if ($node->get('field_tournament_show_toornament')->value) {
        $toornament_id = $node->get('field_tournament_toornament_id')->value;
        $lastMatchResult = $toornament->getLastMatch($toornament_id);

        foreach ($lastMatchResult as $lastMatch) {

          $participant = NULL;
          $participan2 = NULL;
          $result = NULL;
          $result2 = NULL;

          if (isset($lastMatch->opponents) && isset($lastMatch->opponents[0]->participant)) {
            $participant = $lastMatch->opponents[0]->participant->name;
          }
          if (isset($lastMatch->opponents) && isset($lastMatch->opponents[1]->participant)) {
            $participant2 = $lastMatch->opponents[1]->participant->name;
          }
          if (isset($lastMatch->opponents) && isset($lastMatch->opponents[0]->result)) {
            $result = $lastMatch->opponents[0]->score;
          }
          if (isset($lastMatch->opponents) && isset($lastMatch->opponents[1]->result)) {
            $result2 = $lastMatch->opponents[1]->score;
          }
          if (isset($participant) && isset($participant2) && isset($result) && isset($result2)) {

            $ids = \Drupal::entityQuery('node')
              ->condition('status', 1)
              ->condition('title', $lastMatch->id)
              ->condition('type', 'toornament_result')
              ->execute();


            if (count($ids)>0) {
              $node = Node::load(array_pop($ids));
            }
            else {
              $node = Node::create([
                'type' => 'toornament_result',
                'title' => $lastMatch->id,
              ]);
            }

            $node->set('field_toornament_participant', $participant);
            $node->set('field_toornament_participant2', $participant2);
            $node->set('field_toornament_result', $result);
            $node->set('field_toornament_result2', $result2);
            $node->set('field_toornament_tournament', $nid);
            $node->save();
          }
        }
      }
    }

  }


}
