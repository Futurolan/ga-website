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
class StreamBlock extends BlockBase
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {

        $streamNids = \Drupal::entityQuery('stream')->sort('weight', 'ASC')->execute();
        $streamEntities = \Drupal::entityTypeManager()->getStorage("stream")->loadMultiple($streamNids);

        $streams = [];
        foreach ($streamEntities as $streamEntity) {
            $streams[] = array(
                "name" => $streamEntity->label(),
                "type" => $streamEntity->getType(),
                "key" => $streamEntity->getKey(),
            );
        }
        return array(
            '#theme' => "ga_stream_block",
            '#streams' => $streams,
        );
    }
}