<?php

namespace Drupal\ga_platform\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class PlatformForm.
 *
 * @package Drupal\ga_platform\Form
 */
class PlatformForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $platform = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $platform->label(),
      '#description' => $this->t("Label for the Platform."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $platform->id(),
      '#machine_name' => [
        'exists' => '\Drupal\ga_platform\Entity\Platform::load',
      ],
      '#disabled' => !$platform->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $platform = $this->entity;
    $status = $platform->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Platform.', [
          '%label' => $platform->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Platform.', [
          '%label' => $platform->label(),
        ]));
    }
    $form_state->setRedirectUrl($platform->urlInfo('collection'));
  }

}
