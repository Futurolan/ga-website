<?php

namespace Drupal\ga_ticket\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class TicketSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ga_ticket_settings';
  }

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return [
      'ga_ticket.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ga_ticket.settings');

    $form ['title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('title'),
      '#required' => TRUE,
    );

    $form ['weezevent_code'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Weezevent Code'),
      '#default_value' => $config->get('weezevent_code'),
      '#required' => TRUE,
    );

    return parent::buildForm($form, $form_state);

  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state, $plugin_id = NULL, $langcode = NULL) {

    $config = \Drupal::service('config.factory')
      ->getEditable('ga_ticket.settings');

    $config->set('title', $form_state->getValue('title'));
    $config->set('weezevent_code', $form_state->getValue('weezevent_code'));
    $config->set('langcode', \Drupal::languageManager()
      ->getDefaultLanguage()
      ->getId());
    $config->save();

    parent::submitForm($form, $form_state);
    drupal_flush_all_caches();

  }

}


