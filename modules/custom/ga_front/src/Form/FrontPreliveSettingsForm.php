<?php

namespace Drupal\ga_front\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class FrontPreliveSettingsForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'ga_front_prelive_settings';
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
            'ga_front.prelive.settings',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('ga_front.prelive.settings');


        $form ['edition_name'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Edition Name'),
            '#default_value' => $config->get('edition_name'),
            '#required' => TRUE,
        );

        //Event
        $form['event'] = array(
            '#type' => 'details',
            '#title' => t('Event'),
            '#collapsible' => TRUE,
            '#collapsed' => TRUE,
        );

        $form['event']['event_title'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#default_value' => $config->get('event_title'),
            '#required' => TRUE,
        );

        $form['event']['event_text'] = array(
            '#type' => 'text_format',
            '#title' => $this->t('Text'),
            '#default_value' => $config->get('event_text'),
            '#required' => TRUE,
            '#format' => 'formatted_text'
        );

        $form['event']['event_cta'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA text'),
            '#default_value' => $config->get('event_cta'),
            '#required' => TRUE,
        );


        //Planning
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
            '#required' => TRUE,
            '#format' => 'formatted_text'
        );

        $form['planning']['planning_cta'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA text'),
            '#default_value' => $config->get('planning_cta'),
            '#required' => TRUE,
        );

        //Ticket
        $form['ticket'] = array(
            '#type' => 'details',
            '#title' => t('Ticket'),
            '#collapsible' => TRUE,
            '#collapsed' => TRUE,
        );

        $form['ticket']['ticket_text'] = array(
            '#type' => 'text_format',
            '#title' => $this->t('Text'),
            '#default_value' => $config->get('planning_text'),
            '#required' => TRUE,
            '#format' => 'formatted_text'
        );

        $form['ticket']['ticket_cta'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA text'),
            '#default_value' => $config->get('planning_cta'),
            '#required' => TRUE,
        );

        return parent::buildForm($form, $form_state);
    }


    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state, $plugin_id = NULL, $langcode = NULL)
    {
        $config = \Drupal::service('config.factory')->getEditable('ga_front.prelive.settings');

        $config->set('edition_name', $form_state->getValue('edition_name'));
        $config->set('event_title', $form_state->getValue('event_title'));
        $config->set('event_text', $form_state->getValue('event_text')['value']);
        $config->set('event_cta', $form_state->getValue('event_cta'));
        $config->set('planning_text', $form_state->getValue('planning_text')['value']);
        $config->set('planning_cta', $form_state->getValue('planning_cta'));
        $config->set('ticket_text', $form_state->getValue('ticket_text')['value']);
        $config->set('ticket_cta', $form_state->getValue('ticket_cta'));
        $config->set('langcode', \Drupal::languageManager()->getDefaultLanguage()->getId());
        $config->save();

        parent::submitForm($form, $form_state);
    }

}


