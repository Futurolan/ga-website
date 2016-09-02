<?php

namespace Drupal\ga_stream\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class StreamForm.
 *
 * @package Drupal\ga_stream\Form
 */
class StreamForm extends EntityForm
{

    /**
     * {@inheritdoc}
     */
    public function form(array $form, FormStateInterface $form_state)
    {
        $form = parent::form($form, $form_state);

        $stream = $this->entity;
        $form['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#maxlength' => 255,
            '#default_value' => $stream->label(),
            '#description' => $this->t("Label for the Stream."),
            '#required' => TRUE,
        ];

        $form['key'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Key'),
            '#maxlength' => 255,
            '#default_value' => $stream->getKey(),
            '#description' => $this->t("Key for the Stream."),
            '#required' => TRUE,
        ];

        $form['type'] = [
            '#type' => 'select',
            '#title' => $this->t('Type'),
            '#options' => [
                'twitch' => $this->t('Twitch'),
            ],
            '#default_value' => $stream->getType() ? $stream->getType() : "twitch",
            '#description' => $this->t("Type for the Stream."),
            '#required' => TRUE,
        ];

        $form['id'] = [
            '#type' => 'machine_name',
            '#default_value' => $stream->id(),
            '#machine_name' => [
                'exists' => '\Drupal\ga_stream\Entity\Stream::load',
            ],
            '#disabled' => !$stream->isNew(),
        ];

        /* You will need additional form elements for your custom properties. */

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function save(array $form, FormStateInterface $form_state)
    {
        $stream = $this->entity;
        $status = $stream->save();

        switch ($status) {
            case SAVED_NEW:
                drupal_set_message($this->t('Created the %label Stream.', [
                    '%label' => $stream->label(),
                ]));
                break;

            default:
                drupal_set_message($this->t('Saved the %label Stream.', [
                    '%label' => $stream->label(),
                ]));
        }
        $form_state->setRedirectUrl($stream->urlInfo('collection'));
    }
    /**
     * {@inheritdoc}
     */
    protected function actions(array $form, FormStateInterface $form_state) {
        $actions = parent::actions($form, $form_state);
        $actions['submit']['#value'] = ($this->entity->isNew()) ? $this->t('Add Stream') : $this->t('Update Stream');
        return $actions;
    }
}
