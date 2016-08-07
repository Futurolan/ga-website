<?php

namespace Drupal\ga_stream\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Stream entities.
 */
class StreamViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['stream']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Stream'),
      'help' => $this->t('The Stream ID.'),
    );

    return $data;
  }

}
