<?php
namespace Drupal\ga_stream\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Stream' block.
 *
 * @Block(
 *   id = "stream_block",
 *   admin_label = @Translation("Stream block"),
 * )
 */
class StreamBlock extends BlockBase
{
    /**
     * {@inheritdoc}
     */
    public function build() {
        return array(
            '#title' => 'This is an awesome title',
            '#description' => 'Lorem ipsum dolar sum amet ..'
        );
    }
}