<?php

namespace Drupal\ga_stream;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Stream entity.
 *
 * @see \Drupal\ga_stream\Entity\Stream.
 */
class StreamAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\ga_stream\Entity\StreamInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished stream entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published stream entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit stream entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete stream entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add stream entities');
  }

}
