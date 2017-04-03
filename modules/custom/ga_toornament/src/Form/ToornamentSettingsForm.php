<?php

namespace Drupal\ga_toornament\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ToornamentSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ga_toornament_settings';
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
      'ga_toornament.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ga_toornament.settings');


    $form ['api_key'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Api key'),
      '#default_value' => $config->get('api_key'),
      '#required' => TRUE,
    );

    return parent::buildForm($form, $form_state);
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state, $plugin_id = NULL, $langcode = NULL) {

    $config = \Drupal::service('config.factory')
      ->getEditable('ga_toornament.settings');

    $config->set('api_key', $form_state->getValue('api_key'));
    $config->save();

    parent::submitForm($form, $form_state);
    drupal_flush_all_caches();

  }

}


