<?php

namespace Drupal\ga_weezevent\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class WeezeventSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ga_weezevent_settings';
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
      'ga_weezevent.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ga_weezevent.settings');

    $form ['title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('title'),
      '#required' => TRUE,
    );

    $form ['api_key'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Api key'),
      '#default_value' => $config->get('api_key'),
      '#required' => TRUE,
    );

    $form ['access_token'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Access Token'),
      '#default_value' => $config->get('access_token'),
      '#required' => TRUE,
    );

    $form ['id_event'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Id event'),
      '#default_value' => $config->get('id_event'),
      '#required' => TRUE,
    );


    return parent::buildForm($form, $form_state);
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state, $plugin_id = NULL, $langcode = NULL) {

    $config = \Drupal::service('config.factory')
      ->getEditable('ga_weezevent.settings');

    $config->set('title', $form_state->getValue('title'));
    $config->set('api_key', $form_state->getValue('api_key'));
    $config->set('access_token', $form_state->getValue('access_token'));
    $config->set('id_event', $form_state->getValue('id_event'));
    $config->set('langcode', \Drupal::languageManager()
      ->getDefaultLanguage()
      ->getId());
    $config->save();

    parent::submitForm($form, $form_state);
    drupal_flush_all_caches();

  }

}


