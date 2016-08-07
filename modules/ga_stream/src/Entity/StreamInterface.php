<?php

namespace Drupal\ga_stream\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Stream entities.
 *
 * @ingroup ga_stream
 */
interface StreamInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Stream name.
   *
   * @return string
   *   Name of the Stream.
   */
  public function getName();

  /**
   * Sets the Stream name.
   *
   * @param string $name
   *   The Stream name.
   *
   * @return \Drupal\ga_stream\Entity\StreamInterface
   *   The called Stream entity.
   */
  public function setName($name);

  /**
   * Gets the Stream creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Stream.
   */
  public function getCreatedTime();

  /**
   * Sets the Stream creation timestamp.
   *
   * @param int $timestamp
   *   The Stream creation timestamp.
   *
   * @return \Drupal\ga_stream\Entity\StreamInterface
   *   The called Stream entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Stream published status indicator.
   *
   * Unpublished Stream are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Stream is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Stream.
   *
   * @param bool $published
   *   TRUE to set this Stream to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\ga_stream\Entity\StreamInterface
   *   The called Stream entity.
   */
  public function setPublished($published);

}
