<?php
namespace Drupal\ga_stream\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Stream' block.
 *
 * @Block(
 *   id = "ga_stream_block",
 *   admin_label = @Translation("Stream block"),
 * )
 */
class GaStreamBlock extends BlockBase
{
    /**
     * {@inheritdoc}
     */
    public function build() {
        return array(
            '#theme' => 'ga_stream_block',
            '#description' => 'Lorem ipsum dolar sum amet ..'
        );
    }
}