<?php

namespace Drupal\ga_game\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Game entity.
 *
 * @ConfigEntityType(
 *   id = "game",
 *   label = @Translation("Game"),
 *   handlers = {
 *     "list_builder" = "Drupal\ga_game\GameListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ga_game\Form\GameForm",
 *       "edit" = "Drupal\ga_game\Form\GameForm",
 *       "delete" = "Drupal\ga_game\Form\GameDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ga_game\GameHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "game",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/game/{game}",
 *     "add-form" = "/admin/structure/game/add",
 *     "edit-form" = "/admin/structure/game/{game}/edit",
 *     "delete-form" = "/admin/structure/game/{game}/delete",
 *     "collection" = "/admin/structure/game"
 *   }
 * )
 */
class Game extends ConfigEntityBase implements GameInterface
{

    /**
     * The Game ID.
     *
     * @var string
     */
    protected $id;

    /**
     * The Game label.
     *
     * @var string
     */
    protected $label;

    /**
     * The Game entity description.
     *
     * @var string
     */
    protected $description;

    /**
     * The Game entity color.
     *
     * @var string
     */
    protected $color;

    /**
     * The Game entity short name.
     *
     * @var string
     */
    protected $shortName;

    /**
     * The Game entity short name.
     *
     * @var string
     */
    protected $editor;

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * {@inheritdoc}
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * {@inheritdoc}
     */
    public function getEditor()
    {
        return $this->editor;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * {@inheritdoc}
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

    /**
     * {@inheritdoc}
     */
    public function setEditor($editor)
    {
        $this->editor = $editor;
    }
}
