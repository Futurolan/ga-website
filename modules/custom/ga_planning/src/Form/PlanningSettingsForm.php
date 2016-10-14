<?php

namespace Drupal\ga_planning\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class PlanningSettingsForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'ga_planning_settings';
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
            'ga_planning.settings',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('ga_planning.settings');

        $form ['title'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#default_value' => $config->get('title'),
            '#required' => TRUE,
        );

        return parent::buildForm($form, $form_state);

    }


    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state, $plugin_id = NULL, $langcode = NULL)
    {

        $config = \Drupal::service('config.factory')->getEditable('ga_planning.settings');

        $config->set('title', $form_state->getValue('title'));
        $config->set('langcode', \Drupal::languageManager()->getDefaultLanguage()->getId());
        $config->save();

        parent::submitForm($form, $form_state);
    }

}


