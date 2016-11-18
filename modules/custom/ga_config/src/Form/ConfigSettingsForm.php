<?php

namespace Drupal\ga_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class ConfigSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ga_config_settings';
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
      'ga_config.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ga_config.settings');

    //Main sponsor
    $form['main_sponsor'] = array(
      '#type' => 'details',
      '#title' => t('Main sponsor'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );

    $form['main_sponsor']['main_sponsor_image'] = array(
      '#type' => 'managed_file',
      '#title' => t('Image'),
      '#default_value' => $config->get('main_sponsor_image'),
      '#upload_location' => file_default_scheme() . '://global/',
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
      ),
    );

    $form['main_sponsor']['main_sponsor_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Url'),
      '#default_value' => $config->get('main_sponsor_url'),
    );


    //Social Links
    $form['social_links'] = array(
      '#type' => 'details',
      '#title' => t('Social Links'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['social_links']['facebook_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Facebook url'),
      '#default_value' => $config->get('facebook_url'),
    );
    $form['social_links']['twitter_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Twitter url'),
      '#default_value' => $config->get('twitter_url'),
    );
    $form['social_links']['flickr_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Flickr url'),
      '#default_value' => $config->get('flickr_url'),
    );
    $form['social_links']['twitch_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Twitch url'),
      '#default_value' => $config->get('twitch_url'),
    );
    $form['social_links']['youtube_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Youtube url'),
      '#default_value' => $config->get('youtube_url'),
    );



    return parent::buildForm($form, $form_state);
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state, $plugin_id = NULL, $langcode = NULL) {
    $config = \Drupal::service('config.factory')
      ->getEditable('ga_config.settings');

    $config->set('facebook_url', $form_state->getValue('facebook_url'));
    $config->set('twitter_url', $form_state->getValue('twitter_url'));
    $config->set('flickr_url', $form_state->getValue('flickr_url'));
    $config->set('twitch_url', $form_state->getValue('twitch_url'));
    $config->set('youtube_url', $form_state->getValue('youtube_url'));
    $config->set('main_sponsor_image', $form_state->getValue('main_sponsor_image'));
    $config->set('main_sponsor_url', $form_state->getValue('main_sponsor_url'));

    $config->set('langcode', \Drupal::languageManager()
      ->getDefaultLanguage()
      ->getId());

    $file_usage = \Drupal::service('file.usage');


    if ($form_state->getValue('main_sponsor_image')) {
      $file = File::load($form_state->getValue('main_sponsor_image')[0]);
      $file_usage->add($file, "ga_config", "config", 1);
    }

    $config->save();

    parent::submitForm($form, $form_state);

    drupal_flush_all_caches();
  }

}


