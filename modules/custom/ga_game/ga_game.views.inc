<?php

function ga_game_views_data_alter(array &$data) {
  $data['node__field_game']['related_games'] = array(
    'title' => t('Related games'),

    'filter' => array(
      'title' => t('Related games'),
      'help' => t('Specify a list of games node can have.'),
      'group' => "Game",
      'field' => 'field_game_target_id',
      'id' => 'ga_game_related_games'
    ),
  );
}