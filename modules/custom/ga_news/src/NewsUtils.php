<?php
namespace Drupal\ga_news;

use Drupal\Core\Language\LanguageInterface;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;

class NewsUtils
{
    public static function getLastNews()
    {

        $langcode = \Drupal::languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId();

        $newsNids = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('type', 'news')
            ->condition('langcode',$langcode)
            ->sort('created', 'DESC')
            ->range(0, 3)
            ->execute();

        $news = [];

        foreach ($newsNids as $nid) {


            $node = Node::load($nid);

            $node = \Drupal::entityManager()->getTranslationFromContext($node, $langcode);


            $tagsArray = array();
            foreach ($node->field_news_tags as $tag) {
                $tagsArray[] = \Drupal\taxonomy\Entity\Term::load($tag->target_id)->getName();
            }

            $gameId = $node->field_game->target_id;
            $color = null;
            $gameShortName = null;
            if ($gameId) {
                $game = \Drupal::entityTypeManager()->getStorage("game")->load($gameId);
                $color = $game->getColor();
                $gameShortName = $game->getShortName();

            }


            $news[] = array(
                "nid" => $node->id(),
                "title" => $node->getTitle(),
                "image" => count($news) == 0 ? ImageStyle::load('news_front_big')->buildUrl($node->get("field_news_image")->entity->uri->value) : ImageStyle::load('news_front')->buildUrl($node->get("field_news_image")->entity->uri->value),
                "text" => $node->get("field_news_content")->getValue()[0]['summary'],
                "tags" => $tagsArray,
                "gameShortName" => $gameShortName,
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