<?php

/**
 * @file
 * Contains \Drupal\ga_front\Controller\FrontPreLiveController.
 */

namespace Drupal\ga_front\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_news\NewsUtils;
use Drupal\ga_sponsor\SponsorUtils;


class FrontPreLiveController extends ControllerBase
{
    public function render()
    {
        $sponsors = SponsorUtils::getSponsors();
        $news = NewsUtils::getLastNews();

        return array(
            '#theme' => "ga_front_prelive",
            '#slides' => "test",
            '#sponsors' => $sponsors,
            '#news' => $news
        );

    }

}