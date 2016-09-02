<?php
namespace Drupal\ga_tournament\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides 3 tournament front blocks.
 *
 * @Block(
 *   id = "ga_tournament_front_block",
 *   admin_label = @Translation("Tournament front blocks"),
 * )
 */
class TournamentFrontBlock extends BlockBase
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {

        return array(
            '#theme' => "ga_tournament_front_block",
            '#description' => "It's a description"
        );
    }
}