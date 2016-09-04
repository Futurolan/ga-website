<?php
namespace Drupal\ga_sponsor;

use Drupal\Core\Language\LanguageInterface;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;

class SponsorUtils
{
    public static function getSponsors()
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

        return $sponsors;
    }
}