<?php
namespace Drupal\ga_baseinfo_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Base info' block.
 *
 * @Block(
 *   id = "ga_baseinfo_block",
 *   admin_label = @Translation("Base info block"),
 * )
 */
class GaBaseinfoBlock extends BlockBase
{
    /**
     * {@inheritdoc}
     */
    public function build() {
        return array(
            '#theme' => 'ga_baseinfo_block',
            '#description' => '[CONTENT BASEINFO BLOCK]',
        );
    }
}