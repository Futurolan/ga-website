<?php
namespace Drupal\ga_slide\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Slide' block.
 *
 * @Block(
 *   id = "ga_slide_block",
 *   admin_label = @Translation("Slide block"),
 * )
 */
class GaSlideBlock extends BlockBase
{
    /**
     * {@inheritdoc}
     */
    public function build() {
        return array(
            '#theme' => 'ga_slide_block',
            '#description' => '[CONTENT SLIDE BLOCK]'
        );
    }
}