<?php
namespace Drupal\ga_sponsor\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Language\LanguageInterface;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;

/**
 * Provides a 'Slide' block.
 *
 * @Block(
 *   id = "sponsor_front_block",
 *   admin_label = @Translation("Sponsor front block"),
 * )
 */
class SponsorFrontBlock extends BlockBase
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $sponsorNids = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('type', 'sponsor')
            ->execute();

        $sponsors = [];

        $langcode = \Drupal::languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId();
        foreach ($sponsorNids as $nid) {
            $node = Node::load($nid)->getTranslation($langcode);

            $sponsors[] = array(
                "title" => $node->getTitle(),
                "image" => ImageStyle::load('sponsor_front')->buildUrl($node->get("field_sponsor_image")->entity->uri->value),
            );
        }

        shuffle($sponsors);
        $sponsors = array_slice($sponsors,0,6);

        return array(
            '#theme' => 'sponsor_front_block',
            '#sponsors' => $sponsors
        );
    }
}