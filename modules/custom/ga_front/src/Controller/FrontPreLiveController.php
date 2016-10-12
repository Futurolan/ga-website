<?php

/**
 * @file
 * Contains \Drupal\ga_front\Controller\FrontPreLiveController.
 */

namespace Drupal\ga_front\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_news\NewsUtils;
use Drupal\ga_front\FrontUtils;
use Drupal\ga_slide\SlideUtils;
use Drupal\ga_sponsor\SponsorUtils;


class FrontPreLiveController extends ControllerBase
{
    public function render()
    {
        $slides = SlideUtils::getSlides();
        $sponsors = SponsorUtils::getSponsors();
        $news = NewsUtils::getLastNews();
        $config = FrontUtils::getPreliveConfiguration();

        return array(
            '#theme' => "ga_front_prelive",
            '#config' => $config,
            '#slides' => $slides,
            '#sponsors' => $sponsors,
            '#news' => $news
        );

    }

}