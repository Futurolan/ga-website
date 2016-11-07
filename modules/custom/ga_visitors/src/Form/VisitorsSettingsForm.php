<?php

namespace Drupal\ga_visitors\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class VisitorsSettingsForm extends ConfigFormBase
{
  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'ga_visitors_settings';
  }

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames()
  {
    return [
      'ga_visitors.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('ga_visitors.settings');

    $form['ticketing'] = array(
      '#type' => 'checkboxes',
      '#title' => $this->t('Show ticketing CTA'),
      '#default_value' => $config->get('ticketing'),
    );

    $form['general'] = array(
      '#type' => 'details',
      '#title' => t('General'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['general']['title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('title'),
      '#required' => TRUE,
    );
    $form['general']['description'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Description'),
      '#default_value' => $config->get('description'),
      '#required' => TRUE,
      '#format' => 'formatted_text'
    );

    $form['map'] = array(
      '#type' => 'details',
      '#title' => t('Map'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['map']['map_api_key'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Map Api Key'),
      '#default_value' => $config->get('map_api_key'),
      '#required' => TRUE,
    );

    $form['map']['map_place_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Google map place id'),
      '#default_value' => $config->get('map_place_id'),
      '#required' => TRUE,
    );

    $form['planning'] = array(
      '#type' => 'details',
      '#title' => t('Planning'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['planning']['planning_text'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Text'),
      '#default_value' => $config->get('planning_text'),
      '#format' => 'formatted_text'
    );

    $form['price'] = array(
      '#type' => 'details',
      '#title' => t('Price'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['price']['price_text'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Text'),
      '#default_value' => $config->get('price_text'),
      '#format' => 'formatted_text'
    );

    $form['access'] = array(
      '#type' => 'details',
      '#title' => t('Access'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['access']['access_text'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Text'),
      '#default_value' => $config->get('access_text'),
      '#format' => 'formatted_text'
    );

    $form['accommodation'] = array(
      '#type' => 'details',
      '#title' => t('Accommodation'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['accommodation']['accommodation_text'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Text'),
      '#default_value' => $config->get('accommodation_text'),
      '#format' => 'formatted_text'
    );

    $form['accommodation'] = array(
      '#type' => 'details',
      '#title' => t('Accommodation'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['accommodation']['accommodation_text'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Text'),
      '#default_value' => $config->get('accommodation_text'),
      '#format' => 'formatted_text'
    );

    $form['equipment'] = array(
      '#type' => 'details',
      '#title' => t('Equipment'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['equipment']['equipment_text'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Text'),
      '#default_value' => $config->get('equipment_text'),
      '#format' => 'formatted_text'
    );

    $form['food_service'] = array(
      '#type' => 'details',
      '#title' => t('Food service'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['food_service']['food_service_text'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Text'),
      '#default_value' => $config->get('food_service_text'),
      '#format' => 'formatted_text'
    );

    return parent::buildForm($form, $form_state);

  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state, $plugin_id = NULL, $langcode = NULL)
  {

    $config = \Drupal::service('config.factory')->getEditable('ga_visitors.settings');

    $config->set('ticketing', $form_state->getValue('ticketing'));
    $config->set('title', $form_state->getValue('title'));
    $config->set('description', $form_state->getValue('description')['value']);
    $config->set('map_api_key', $form_state->getValue('map_api_key'));
    $config->set('map_place_id', $form_state->getValue('map_place_id'));
    $config->set('planning_text', $form_state->getValue('planning_text')['value']);
    $config->set('price_text', $form_state->getValue('price_text')['value']);
    $config->set('access_text', $form_state->getValue('access_text')['value']);
    $config->set('accommodation_text', $form_state->getValue('accommodation_text')['value']);
    $config->set('equipment_text', $form_state->getValue('equipment_text')['value']);
    $config->set('food_service_text', $form_state->getValue('food_service_text')['value']);
    $config->set('langcode', \Drupal::languageManager()->getDefaultLanguage()->getId());
    $config->save();

    parent::submitForm($form, $form_state);
  }

}


