<?php

namespace Drupal\ga_family\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Family level entity.
 *
 * @ConfigEntityType(
 *   id = "family_level",
 *   label = @Translation("Family level"),
 *   handlers = {
 *     "list_builder" = "Drupal\ga_family\FamilyLevelListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ga_family\Form\FamilyLevelForm",
 *       "edit" = "Drupal\ga_family\Form\FamilyLevelForm",
 *       "delete" = "Drupal\ga_family\Form\FamilyLevelDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ga_family\FamilyLevelHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "family_level",
 *   admin_permission = "administer family_level",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "weight" = "weight",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/family_level/{family_level}",
 *     "add-form" = "/admin/structure/family_level/add",
 *     "edit-form" = "/admin/structure/family_level/{family_level}/edit",
 *     "delete-form" = "/admin/structure/family_level/{family_level}/delete",
 *     "collection" = "/admin/structure/family_level"
 *   }
 * )
 */
class FamilyLevel extends ConfigEntityBase implements FamilyLevelInterface {

  /**
   * The Family level ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Family level label.
   *
   * @var string
   */
  protected $label;

  /**
   * The Family level display front status.
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
