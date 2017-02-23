<?php

namespace Drupal\ga_sponsor\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SponsorLevelForm.
 *
 * @package Drupal\ga_sponsor\Form
 */
class SponsorLevelForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $sponsor_level = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $sponsor_level->label(),
      '#description' => $this->t("Label for the Sponsor level."),
      '#required' => TRUE,
    ];

    $form['display_front'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Display in front page'),
      '#maxlength' => 255,
      '#default_value' => $sponsor_level->getDisplayFront(),
    ];


    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $sponsor_level->id(),
      '#machine_name' => [
        'exists' => '\Drupal\ga_sponsor\Entity\SponsorLevel::load',
      ],
      '#disabled' => !$sponsor_level->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $sponsor_level = $this->entity;
    $status = $sponsor_level->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Sponsor level.', [
          '%label' => $sponsor_level->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Sponsor level.', [
          '%label' => $sponsor_level->label(),
        ]));
    }
    $form_state->setRedirectUrl($sponsor_level->urlInfo('collection'));
  }

}
