<?php

namespace Drupal\ga_platform\Plugin\views\filter;

use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\Plugin\views\filter\ManyToOne;
use Drupal\views\ViewExecutable;

/**
 * Filters by given list of event title options.
 *
 * @ingroup views_filter_handlers
 *
 * @ViewsFilter("ga_platform_related_platforms")
 */
class RelatedPlatforms extends ManyToOne
{
    /**
     * {@inheritdoc}
     */
    public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL)
    {
        parent::init($view, $display, $options);
        $this->valueTitle = t('Allowed platforms');
        $this->definition['options callback'] = array($this, 'generateOptions');
    }

    /**
     * Helper function that generates the options.
     * @return array
     */
    public function generateOptions()
    {
        $platformNids = \Drupal::entityQuery('platform')->sort('label', 'ASC')->execute();
        $platformEntities = \Drupal::entityTypeManager()->getStorage("platform")->loadMultiple($platformNids);

        $res = array();
        foreach ($platformEntities as $plateformEntity) {
            $res[$plateformEntity->id()] = $plateformEntity->label();
        }

        return $res;
    }
}