<?php
namespace Drupal\ga_news;

use Drupal\Core\Language\LanguageInterface;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;

class NewsUtils
{
    public static function getLastNews()
    {
        $newsNids = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('type', 'news')
            ->sort('created', 'DESC')
            ->range(0, 3)
            ->execute();

        $news = [];

        $langcode = \Drupal::languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId();
        foreach ($newsNids as $nid) {
            $node = Node::load($nid)->getTranslation($langcode);

            //TODO Load all tags
            $tags = \Drupal\taxonomy\Entity\Term::loadMultiple($node->field_news_tags->value);

            $tagsArray = array();
            foreach($tags as $tag){
                $tagsArray[] = $tag->getName();
            }

            kpr($tagsArray);

            $gameId = $node->field_news_game->target_id;
            $color = null;
            if ($gameId) {
                $game = \Drupal::entityTypeManager()->getStorage("game")->load($gameId);
                $color =$game->getColor();
            }

            $news[] = array(
                "nid" => $node->id(),
                "title" => $node->getTitle(),
                "image" => count($news) == 0 ? ImageStyle::load('news_front_big')->buildUrl($node->get("field_news_image")->entity->uri->value) : ImageStyle::load('news_front')->buildUrl($node->get("field_news_image")->entity->uri->value),
                "text" => $node->get("field_news_content")->getValue()[0]['summary'],
                "tags" => join(',',$tagsArray),
                "color" => $color,
                "url" => $node->url()
            );
        }
        return $news;
    }

    public static function getNextPrevIds($created)
    {

        $nextId = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('created', $created, '<')
            ->condition('langcode', \Drupal::languageManager()->getCurrentLanguage()->getId())
            ->condition('type', 'news')
            ->sort('created', 'DESC')
            ->range(0, 1)
            ->execute();

        $prevId = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('created', $created, '>')
            ->condition('langcode', \Drupal::languageManager()->getCurrentLanguage()->getId())
            ->condition('type', 'news')
            ->sort('created', 'ASC')
            ->range(0, 1)
            ->execute();

        return array("prev" => count($prevId) > 0 ? key($prevId) : null, "next" => count($nextId) > 0 ? key($nextId) : null);
    }
}