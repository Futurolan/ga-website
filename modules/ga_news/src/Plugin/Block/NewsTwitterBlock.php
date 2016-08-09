<?php
namespace Drupal\ga_news\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Language\LanguageInterface;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;

/**
 * Provides a 'News & Twitter' block.
 *
 * @Block(
 *   id = "ga_news_twitter_block",
 *   admin_label = @Translation("News & Twitter Block"),
 * )
 */
class NewsTwitterBlock extends BlockBase
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {

        $newsNids = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('type', 'news')
            ->range(0, 3)
            ->execute();

        $news = [];

        $langcode = \Drupal::languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId();
        foreach ($newsNids as $nid) {
            $node = Node::load($nid)->getTranslation($langcode);
            $news[] = array(
                "title" => $node->getTitle(),
                "image" => ImageStyle::load('news_front')->buildUrl($node->get("field_news_image")->entity->uri->value),
                "text" => $node->get("field_news_content")->getValue()[0]['summary'],
            );
        }


        return array(
            '#theme' => 'ga_news_twitter_block',
            '#news' => $news,
        );
    }
}