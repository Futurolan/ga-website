<?php
namespace Drupal\ga_sponsor;

use Drupal\Core\Language\LanguageInterface;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;

class SponsorUtils
{
    public static function getFrontSponsors()
    {
        $sponsorNids = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('type', 'sponsor')
            ->sort('field_sponsor_weight')
            ->execute();

        $sponsors = [];

        $langcode = \Drupal::languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId();
        foreach ($sponsorNids as $nid) {
            $node = Node::load($nid)->getTranslation($langcode);

            $sponsors[] = array(
                "title" => $node->getTitle(),
                "image" => ImageStyle::load('sponsor_front')->buildUrl($node->get("field_sponsor_image")->entity->uri->value)
            );
        }

        return $sponsors;
    }

    public static function getSponsors()
    {
        $sponsorNids = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('type', 'sponsor')
            ->sort('field_sponsor_weight')
            ->execute();

        $sponsors = [];

        $langcode = \Drupal::languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId();
        foreach ($sponsorNids as $nid) {
            $node = Node::load($nid)->getTranslation($langcode);

            $sponsors[$node->field_sponsor_level->value][]= array(
                "title" => $node->getTitle(),
                "url" => $node->field_sponsor_url->value,
                "image" => ImageStyle::load('sponsor_front')->buildUrl($node->get("field_sponsor_image")->entity->uri->value)
            );
        }
        return $sponsors;
    }

    public static function getConfiguration()
    {
        $config = \Drupal::config('ga_sponsor.settings');

        $variables['title'] = $config->get('title');
        $variables['lvl0'] = $config->get('lvl0');
        $variables['lvl1'] = $config->get('lvl1');
        $variables['lvl2'] = $config->get('lvl2');
        $variables['lvl3'] = $config->get('lvl3');
        $variables['lvl4'] = $config->get('lvl4');
        return $variables;
    }
}