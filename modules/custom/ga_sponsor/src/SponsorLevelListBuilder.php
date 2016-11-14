<?php

namespace Drupal\ga_sponsor;

use Drupal\Core\Config\Entity\DraggableListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a listing of Sponsor level entities.
 */
class SponsorLevelListBuilder extends DraggableListBuilder {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ga_sponsor_entity_sponsor_level_config';
  }


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Sponsor level');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    // You probably want a few more properties here...
    return $row + parent::buildRow($entity);
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    drupal_set_message(t('The sponsor levels settings have been updated.'));
  }
}
