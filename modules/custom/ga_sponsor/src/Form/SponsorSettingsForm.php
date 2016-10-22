<?php

namespace Drupal\ga_sponsor\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class SponsorSettingsForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'ga_sponsor_settings';
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
            'ga_sponsor.settings',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('ga_sponsor.settings');

        $form ['title'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#default_value' => $config->get('title'),
            '#required' => TRUE,
        );

        $form ['lvl0'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Level 0 name'),
            '#default_value' => $config->get('lvl0'),
            '#required' => TRUE,
        );

        $form ['lvl1'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Level 1 name'),
            '#default_value' => $config->get('lvl1'),
            '#required' => TRUE,
        );

        $form ['lvl2'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Level 2 name'),
            '#default_value' => $config->get('lvl2'),
            '#required' => TRUE,
        );

        $form ['lvl3'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Level 3 name'),
            '#default_value' => $config->get('lvl3'),
            '#required' => TRUE,
        );

        $form ['lvl4'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Level 4 name'),
            '#default_value' => $config->get('lvl4'),
            '#required' => TRUE,
        );



        return parent::buildForm($form, $form_state);

    }


    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state, $plugin_id = NULL, $langcode = NULL)
    {

        $config = \Drupal::service('config.factory')->getEditable('ga_sponsor.settings');

        $config->set('title', $form_state->getValue('title'));
        $config->set('lvl0', $form_state->getValue('lvl0'));
        $config->set('lvl1', $form_state->getValue('lvl1'));
        $config->set('lvl2', $form_state->getValue('lvl2'));
        $config->set('lvl3', $form_state->getValue('lvl3'));
        $config->set('lvl4', $form_state->getValue('lvl4'));
        $config->set('langcode', \Drupal::languageManager()->getDefaultLanguage()->getId());
        $config->save();

        parent::submitForm($form, $form_state);
    }

}


