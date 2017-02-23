<?php

namespace Drupal\ga_sponsor\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Sponsor level entity.
 *
 * @ConfigEntityType(
 *   id = "sponsor_level",
 *   label = @Translation("Sponsor level"),
 *   handlers = {
 *     "list_builder" = "Drupal\ga_sponsor\SponsorLevelListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ga_sponsor\Form\SponsorLevelForm",
 *       "edit" = "Drupal\ga_sponsor\Form\SponsorLevelForm",
 *       "delete" = "Drupal\ga_sponsor\Form\SponsorLevelDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ga_sponsor\SponsorLevelHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "sponsor_level",
 *   admin_permission = "administer sponsor_level",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "weight" = "weight",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/sponsor_level/{sponsor_level}",
 *     "add-form" = "/admin/structure/sponsor_level/add",
 *     "edit-form" = "/admin/structure/sponsor_level/{sponsor_level}/edit",
 *     "delete-form" = "/admin/structure/sponsor_level/{sponsor_level}/delete",
 *     "collection" = "/admin/structure/sponsor_level"
 *   }
 * )
 */
class SponsorLevel extends ConfigEntityBase implements SponsorLevelInterface {

  /**
   * The Sponsor level ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Sponsor level label.
   *
   * @var string
   */
  protected $label;

  /**
   * The Sponsor level display front status.
   *
   * @var string
   */
  protected $display_front;

  /**
   * {@inheritdoc}
   */
  public function getDisplayFront() {
      return $this->display_front;
  }

  /**
   * {@inheritdoc}
   */
  public function setDisplayFront($display_front) {
    $this->display_front = $display_front;
  }
}
