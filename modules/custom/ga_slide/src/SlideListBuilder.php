<?php

namespace Drupal\ga_slide;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Config\Entity\DraggableListBuilder;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a listing of Slide entities.
 */
class SlideListBuilder extends DraggableListBuilder
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'ga_slide_entity_slide_config';
    }

    /**
     * {@inheritdoc}
     */
    public function buildHeader()
    {
        $header['label'] = $this->t('Slide');
        return $header + parent::buildHeader();
    }

    /**
     * {@inheritdoc}
     */
    public function buildRow(EntityInterface $entity)
    {
        $row['label'] = $entity->label();
        // You probably want a few more properties here...
        return $row + parent::buildRow($entity);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        parent::submitForm($form, $form_state);
        drupal_set_message(t('The slide settings have been updated.'));
    }
}
