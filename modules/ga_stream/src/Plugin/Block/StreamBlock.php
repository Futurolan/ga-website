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

        $streamNids = \Drupal::entityQuery('stream')->execute();
        $streamEntities = \Drupal::entityTypeManager()->getStorage("stream")->loadMultiple($streamNids);

        $streams = [];
        foreach ($streamEntities as $streamEntity) {
            $streams[] = array(
                "type" => $streamEntity->get('field_stream_type')->value,
                "id" => $streamEntity->get('field_stream_id')->value,
            );
        }

        return array(
            '#theme' => "ga_stream_block",
            '#streams' => $streams
        );
    }
}