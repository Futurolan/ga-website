<?php

namespace Drupal\ga_platform\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Platform entity.
 *
 * @ConfigEntityType(
 *   id = "platform",
 *   label = @Translation("Platform"),
 *   handlers = {
 *     "list_builder" = "Drupal\ga_platform\PlatformListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ga_platform\Form\PlatformForm",
 *       "edit" = "Drupal\ga_platform\Form\PlatformForm",
 *       "delete" = "Drupal\ga_platform\Form\PlatformDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ga_platform\PlatformHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "platform",
 *   admin_permission = "administer platforms",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/platform/{platform}",
 *     "add-form" = "/admin/structure/platform/add",
 *     "edit-form" = "/admin/structure/platform/{platform}/edit",
 *     "delete-form" = "/admin/structure/platform/{platform}/delete",
 *     "collection" = "/admin/structure/platform"
 *   }
 * )
 */
class Platform extends ConfigEntityBase implements PlatformInterface {

  /**
   * The Platform ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Platform label.
   *
   * @var string
   */
  protected $label;

}
