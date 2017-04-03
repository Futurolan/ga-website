<?php

namespace Drupal\ga_toornament;

use GuzzleHttp\Exception\RequestException;

class ToornamentAPI {
  private $base_uri = "https://api.toornament.com";
  private $api_key = NULL;

  public function __construct($api_key) {
    $this->api_key = $api_key;
  }

  public function getLastMatch($tournaments_id) {
    $client = \Drupal::httpClient();

    try {
      $response = $client->get('/v1/tournaments/'.$tournaments_id .'/matches',
        array(
          'headers' => array(
            'X-Api-Key'=>$this->api_key
          ),
          'base_uri' => $this->base_uri,
          'query' => array(
            'has_result'=>1,
            'sort'=>'latest'
          )
        )
      );

      $data = (string) $response->getBody();
      return \GuzzleHttp\json_decode($data);

    } catch (RequestException $e) {
      watchdog_exception('ga_weezevent', $e);
    } catch (\InvalidArgumentException $e) {
      watchdog_exception('ga_weezevent', $e);
    }
  }
}