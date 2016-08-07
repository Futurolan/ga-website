<?php

/**
 * @file
 * Contains stream.page.inc.
 *
 * Page callback for Stream entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Stream templates.
 *
 * Default template: stream.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_stream(array &$variables) {
  // Fetch Stream Entity Object.
  $stream = $variables['elements']['#stream'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
