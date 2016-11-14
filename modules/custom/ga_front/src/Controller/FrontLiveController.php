<?php

/**
 * @file
 * Contains \Drupal\ga_front\Controller\FrontLiveController.
 */

namespace Drupal\ga_front\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_news\NewsUtils;
use Drupal\ga_sponsor\SponsorUtils;
use Drupal\ga_stream\StreamUtils;


class FrontLiveController extends ControllerBase {
  public function render() {
    $streams = StreamUtils::getStreams();
    $news = NewsUtils::getLastNews();
    $sponsors = SponsorUtils::getSponsors();

    return array(
      '#theme' => "ga_front_live",
      '#streams' => $streams,
      '#sponsors' => $sponsors,
      '#news' => $news
    );

  }

}