<?php

namespace Drupal\ga_slide\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Class SlidemForm.
 *
 * @package Drupal\ga_slide\Form
 */
class SlideForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $slide = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $slide->label(),
      '#required' => TRUE,
    ];

    $form['image'] = array(
      '#type' => 'managed_file',
      '#title' => t('Image'),
      '#default_value' => $slide->getImage(),
      '#description' => 'Best size : 1920x518',
      '#upload_location' => file_default_scheme() . '://front/slide/',
      '#required' => TRUE,
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
      ),
    );

    $form['video'] = array(
      '#type' => 'managed_file',
      '#title' => t('Video'),
      '#default_value' => $slide->getVideo(),
      '#description' => 'Best size : 1920x518',
      '#upload_location' => file_default_scheme() . '://front/slide/',
      '#upload_validators' => array(
        'file_validate_extensions' => array('mp4 webm'),
      ),
    );

    $form['link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link'),
      '#maxlength' => 255,
      '#default_value' => $slide->getLink(),
      '#description' => $this->t("Use relative link for internal url."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $slide->id(),
      '#machine_name' => [
        'exists' => '\Drupal\ga_slide\Entity\Slide::load',
      ],
      '#disabled' => !$slide->isNew(),
    ];


    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $file = File::load($form_state->getValue('image')[0]);
    $file_usage = \Drupal::service('file.usage');
    $file_usage->add($file, "ga_slide", "config", 1);

    if ($form_state->getValue('video')) {
      $file = File::load($form_state->getValue('video')[0]);
      $file_usage->add($file, "ga_slide", "config", 1);
    }

    $slide = $this->entity;
    $status = $slide->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Slide.', [
          '%label' => $slide->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Slide.', [
          '%label' => $slide->label(),
        ]));
    }
    $form_state->setRedirectUrl($slide->urlInfo('collection'));
  }

  /**
   * {@inheritdoc}
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['submit']['#value'] = ($this->entity->isNew()) ? $this->t('Add Slide') : $this->t('Update Slide');
    return $actions;
  }
}
