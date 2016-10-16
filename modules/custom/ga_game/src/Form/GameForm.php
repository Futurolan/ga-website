<?php

namespace Drupal\ga_game\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class GameForm.
 *
 * @package Drupal\ga_game\Form
 */
class GameForm extends EntityForm
{

    /**
     * {@inheritdoc}
     */
    public function form(array $form, FormStateInterface $form_state)
    {
        $form = parent::form($form, $form_state);

        $game = $this->entity;
        $form['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
            '#maxlength' => 255,
            '#default_value' => $game->label(),
            '#required' => TRUE,
        ];

        $form['shortName'] = [
            '#type' => 'textfield',
            '#title' => $this->t('ShortName'),
            '#maxlength' => 255,
            '#default_value' => $game->getShortName(),
            '#required' => TRUE,
        ];

        $form['color'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Color'),
            '#maxlength' => 255,
            '#default_value' => $game->getColor(),
            '#description' => $this->t("Hexacolor (ex:#FF0000)"),
            '#required' => TRUE,
        ];

        $form['editor'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Editor'),
            '#maxlength' => 255,
            '#default_value' => $game->getEditor(),
            '#required' => TRUE,
        ];

        $form['description'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('Description'),
            '#default_value' => $game->getDescription(),
            '#required' => TRUE,
        );

        $form['id'] = [
            '#type' => 'machine_name',
            '#default_value' => $game->id(),
            '#machine_name' => [
                'exists' => '\Drupal\ga_game\Entity\Game::load',
            ],
            '#disabled' => !$game->isNew(),
        ];

        /* You will need additional form elements for your custom properties. */

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function save(array $form, FormStateInterface $form_state)
    {
        $game = $this->entity;
        $status = $game->save();

        switch ($status) {
            case SAVED_NEW:
                drupal_set_message($this->t('Created the %label Game.', [
                    '%label' => $game->label(),
                ]));
                break;

            default:
                drupal_set_message($this->t('Saved the %label Game.', [
                    '%label' => $game->label(),
                ]));
        }
        $form_state->setRedirectUrl($game->urlInfo('collection'));
    }
}
