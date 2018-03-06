<?php

namespace Drupal\ga_family\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class FamilyLevelForm.
 *
 * @package Drupal\ga_family\Form
 */
class FamilyLevelForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $family_level = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $family_level->label(),
      '#description' => $this->t("Label for the Family level."),
      '#required' => TRUE,
    ];

    $form['display_front'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Display in front page'),
      '#maxlength' => 255,
      '#default_value' => $family_level->getDisplayFront(),
    ];


    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $family_level->id(),
      '#machine_name' => [
        'exists' => '\Drupal\ga_family\Entity\FamilyLevel::load',
      ],
      '#disabled' => !$family_level->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $family_level = $this->entity;
    $status = $family_level->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Family level.', [
          '%label' => $family_level->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Family level.', [
          '%label' => $family_level->label(),
        ]));
    }
    $form_state->setRedirectUrl($family_level->urlInfo('collection'));
  }

}
