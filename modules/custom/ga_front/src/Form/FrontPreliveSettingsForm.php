<?php

namespace Drupal\ga_front\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

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

        //First Box
        $form['b1'] = array(
            '#type' => 'details',
            '#title' => t('First Box'),
            '#collapsible' => TRUE,
            '#collapsed' => TRUE,
        );

        $form['b1']['b1_reverse'] = array(
            '#type' => 'checkbox',
            '#title' => $this->t('Switch color'),
            '#default_value' => $config->get('b1_reverse'),
        );

        $form['b1']['b1_title'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#default_value' => $config->get('b1_title'),
        );

        $form['b1']['b1_text'] = array(
            '#type' => 'text_format',
            '#title' => $this->t('Text'),
            '#default_value' => $config->get('b1_text'),
            '#required' => TRUE,
            '#format' => 'formatted_text'
        );

        $form['b1']['b1_cta'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA text'),
            '#default_value' => $config->get('b1_cta'),
        );

        $form['b1']['b1_link'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA link'),
            '#description' => t("Use relative path"),
            '#default_value' => $config->get('b1_link'),
        );

        $form['b1']['b1_image'] = array(
            '#type' => 'managed_file',
            '#title' => t('Image'),
            '#default_value' => $config->get('b1_image'),
            '#upload_location' => file_default_scheme() . '://front/box/',
            '#upload_validators' => array(
                'file_validate_extensions' => array('gif png jpg jpeg'),
            ),
        );


        //Second Box
        $form['b2'] = array(
            '#type' => 'details',
            '#title' => t('Second Box'),
            '#collapsible' => TRUE,
            '#collapsed' => TRUE,
        );

        $form['b2']['b2_reverse'] = array(
            '#type' => 'checkbox',
            '#title' => $this->t('Switch color'),
            '#default_value' => $config->get('b2_reverse'),
        );

        $form['b2']['b2_title'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#default_value' => $config->get('b2_title'),
        );

        $form['b2']['b2_text'] = array(
            '#type' => 'text_format',
            '#title' => $this->t('Text'),
            '#default_value' => $config->get('b2_text'),
            '#required' => TRUE,
            '#format' => 'formatted_text'
        );

        $form['b2']['b2_cta'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA text'),
            '#default_value' => $config->get('b2_cta'),
        );

        $form['b2']['b2_link'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA link'),
            '#description' => t("Use relative path"),
            '#default_value' => $config->get('b2_link'),
        );

        $form['b2']['b2_image'] = array(
            '#type' => 'managed_file',
            '#title' => t('Image'),
            '#default_value' => $config->get('b2_image'),
            '#upload_location' => file_default_scheme() . '://front/box/',
            '#upload_validators' => array(
                'file_validate_extensions' => array('gif png jpg jpeg'),
            ),
        );


        //Third Box
        $form['b3'] = array(
            '#type' => 'details',
            '#title' => t('Third Box'),
            '#collapsible' => TRUE,
            '#collapsed' => TRUE,
        );

        $form['b3']['b3_reverse'] = array(
            '#type' => 'checkbox',
            '#title' => $this->t('Switch color'),
            '#default_value' => $config->get('b3_reverse'),
        );

        $form['b3']['b3_title'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#default_value' => $config->get('b3_title'),
        );

        $form['b3']['b3_text'] = array(
            '#type' => 'text_format',
            '#title' => $this->t('Text'),
            '#default_value' => $config->get('b3_text'),
            '#required' => TRUE,
            '#format' => 'formatted_text'
        );

        $form['b3']['b3_cta'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA text'),
            '#default_value' => $config->get('b3_cta'),
        );

        $form['b3']['b3_link'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('CTA link'),
            '#description' => t("Use relative path"),
            '#default_value' => $config->get('b3_link')
        );

        $form['b3']['b3_image'] = array(
            '#type' => 'managed_file',
            '#title' => t('Image'),
            '#default_value' => $config->get('b3_image'),
            '#upload_location' => file_default_scheme() . '://front/box/',
            '#upload_validators' => array(
                'file_validate_extensions' => array('gif png jpg jpeg'),
            ),
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
        $config->set('b1_reverse', $form_state->getValue('b1_reverse'));
        $config->set('b1_title', $form_state->getValue('b1_title'));
        $config->set('b1_text', $form_state->getValue('b1_text')['value']);
        $config->set('b1_cta', $form_state->getValue('b1_cta'));
        $config->set('b1_link', $form_state->getValue('b1_link'));
        $config->set('b1_image', $form_state->getValue('b1_image'));
        $config->set('b2_reverse', $form_state->getValue('b2_reverse'));
        $config->set('b2_title', $form_state->getValue('b2_title'));
        $config->set('b2_text', $form_state->getValue('b2_text')['value']);
        $config->set('b2_cta', $form_state->getValue('b2_cta'));
        $config->set('b2_link', $form_state->getValue('b2_link'));
        $config->set('b2_image', $form_state->getValue('b2_image'));
        $config->set('b3_reverse', $form_state->getValue('b3_reverse'));
        $config->set('b3_title', $form_state->getValue('b3_title'));
        $config->set('b3_text', $form_state->getValue('b3_text')['value']);
        $config->set('b3_cta', $form_state->getValue('b3_cta'));
        $config->set('b3_link', $form_state->getValue('b3_link'));
        $config->set('b3_image', $form_state->getValue('b3_image'));
        $config->set('langcode', \Drupal::languageManager()->getDefaultLanguage()->getId());

        $file_usage = \Drupal::service('file.usage');


        if ($form_state->getValue('b1_image')) {
            $file = File::load($form_state->getValue('b1_image')[0]);
            $file_usage->add($file, "ga_front", "config", 1);
        }
        if ($form_state->getValue('b2_image')) {
            $file = File::load($form_state->getValue('b2_image')[0]);
            $file_usage->add($file, "ga_front", "config", 1);
        }
        if ($form_state->getValue('b3_image')) {
            $file = File::load($form_state->getValue('b3_image')[0]);
            $file_usage->add($file, "ga_front", "config", 1);
        }

        $config->save();

        parent::submitForm($form, $form_state);
    }

}


