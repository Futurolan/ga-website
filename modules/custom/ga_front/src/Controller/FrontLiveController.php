<?php

/**
 * @file
 * Contains \Drupal\ga_front\Controller\FrontLiveController.
 */

namespace Drupal\ga_front\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_front\FrontUtils;
use Drupal\ga_news\NewsUtils;
use Drupal\ga_sponsor\SponsorUtils;
use Drupal\ga_stream\StreamUtils;
use Drupal\ga_toornament\ToornamentUtils;


class FrontLiveController extends ControllerBase {
  public function render() {
    $streams = StreamUtils::getStreams();
    $news = NewsUtils::getLastNews();
    $sponsors = SponsorUtils::getSponsors();
    $config = FrontUtils::getLiveConfiguration();
    $lastMatch = ToornamentUtils::getLastMatch();


    return array(
      '#theme' => "ga_front_live",
      '#config' => $config,
      '#streams' => $streams,
      '#sponsors' => $sponsors,
      '#news' => $news,
      '#lastMatch' => $lastMatch
    );

  }

}