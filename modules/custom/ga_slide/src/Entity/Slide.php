<?php

namespace Drupal\ga_slide\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Slide entity.
 *
 * @ConfigEntityType(
 *   id = "slide",
 *   label = @Translation("Slide"),
 *   handlers = {
 *     "list_builder" = "Drupal\ga_slide\SlideListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ga_slide\Form\SlideForm",
 *       "edit" = "Drupal\ga_slide\Form\SlideForm",
 *       "delete" = "Drupal\ga_slide\Form\SlideDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ga_slide\SlideHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "slide",
 *   admin_permission = "administer slides",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "weight" = "weight",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/slide/{slide}",
 *     "add-form" = "/admin/structure/slide/add",
 *     "edit-form" = "/admin/structure/slide/{slide}/edit",
 *     "delete-form" = "/admin/structure/slide/{slide}/delete",
 *     "collection" = "/admin/structure/slide"
 *   }
 * )
 */
class Slide extends ConfigEntityBase implements SlideInterface {

  /**
   * The Slide ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Slide label.
   *
   * @var string
   */
  protected $label;

  /**
   * The Slide image.
   *
   * @var string
   */
  protected $image;

  /**
   * The Slide video.
   *
   * @var string
   */
  protected $video;


  /**
   * The Slide link.
   *
   * @var string
   */
  protected $link;

  /**
   * {@inheritdoc}
   */
  public function getImage() {
    return $this->image;
  }

  /**
   * {@inheritdoc}
   */
  public function getLink() {
    return $this->link;
  }

  /**
   * {@inheritdoc}
   */
  public function getVideo() {
    return $this->video;
  }

  /**
   * {@inheritdoc}
   */
  public function setImage($image) {
    $this->image = $image;
  }

  /**
   * {@inheritdoc}
   */
  public function setLink($link) {
    $this->link = $link;
  }

  /**
   * {@inheritdoc}
   */
  public function setVideo($video) {
    $this->video = $video;
  }

}
