<?php

namespace Drupal\ga_stream\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Stream entity.
 *
 * @ConfigEntityType(
 *   id = "stream",
 *   label = @Translation("Stream"),
 *   handlers = {
 *     "list_builder" = "Drupal\ga_stream\StreamListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ga_stream\Form\StreamForm",
 *       "edit" = "Drupal\ga_stream\Form\StreamForm",
 *       "delete" = "Drupal\ga_stream\Form\StreamDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ga_stream\StreamHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "stream",
 *   admin_permission = "administer streams",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "weight" = "weight",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/stream/{stream}",
 *     "add-form" = "/admin/structure/stream/add",
 *     "edit-form" = "/admin/structure/stream/{stream}/edit",
 *     "delete-form" = "/admin/structure/stream/{stream}/delete",
 *     "collection" = "/admin/structure/stream"
 *   }
 * )
 */
class Stream extends ConfigEntityBase implements StreamInterface {

  /**
   * The Stream ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Stream label.
   *
   * @var string
   */
  protected $label;

  /**
   * The Stream key.
   *
   * @var string
   */
  protected $key;

  /**
   * The Stream type.
   *
   * @var string
   */
  protected $type;

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return $this->key;
  }

  /**
   * {@inheritdoc}
   */
  public function getType() {
    return $this->type;
  }

  /**
   * {@inheritdoc}
   */
  public function setKey($key) {
    $this->key = $key;
  }

  /**
   * {@inheritdoc}
   */
  public function setType($type) {
    $this->type = $type;
  }


}
