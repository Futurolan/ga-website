<?php

namespace Drupal\ga_game\Plugin\views\filter;

use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\Plugin\views\filter\ManyToOne;
use Drupal\views\ViewExecutable;

/**
 * Filters by given list of event title options.
 *
 * @ingroup views_filter_handlers
 *
 * @ViewsFilter("ga_game_related_games")
 */
class RelatedGames extends ManyToOne {
  /**
   * {@inheritdoc}
   */
  public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL) {
    parent::init($view, $display, $options);
    $this->valueTitle = t('Allowed games');
    $this->definition['options callback'] = array($this, 'generateOptions');
  }

  /**
   * Helper function that generates the options.
   * @return array
   */
  public function generateOptions() {
    $gameNids = \Drupal::entityQuery('game')->sort('label', 'ASC')->execute();
    $gameEntities = \Drupal::entityTypeManager()
      ->getStorage("game")
      ->loadMultiple($gameNids);

    $res = array();
    foreach ($gameEntities as $gameEntity) {
      $res[$gameEntity->id()] = $gameEntity->label();
    }

    return $res;
  }
}