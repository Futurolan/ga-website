<?php

function ga_platform_views_data_alter(array &$data) {
  $data['node__field_platform']['related_platforms'] = array(
    'title' => t('Related platforms'),

    'filter' => array(
      'title' => t('Related platforms'),
      'help' => t('Specify a list of platforms node can have.'),
      'group' => "Platform",
      'field' => 'field_platform_target_id',
      'id' => 'ga_platform_related_platforms'
    ),
  );
}