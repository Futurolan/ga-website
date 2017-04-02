<?php

namespace Drupal\ga_toornament;

class WeezeventAPI {
  private $base_uri = "https://api.toornament.com/v1";
  private $api_key = NULL;

  public function __construct($api_key) {
    $this->api_key = $api_key;
  }

  public function participants($id_ticket) {
    $client = \Drupal::httpClient();

    try {
      $response = $client->get('/participants',
        array(
          'base_uri' => $this->base_uri,
          'query' => array(
            'api_key' => $this->api_key,
            'access_token' => $this->access_token,
            'id_ticket[]' => $id_ticket,
            'full' => 1
          )
        )
      );

      $data = (string) $response->getBody();
      return \GuzzleHttp\json_decode($data);

    } catch (RequestException $e) {
      watchdog_exception('ga_weezevent', $e->getMessage());
    } catch (InvalidArgumentException $e) {
      watchdog_exception('ga_weezevent', $e->getMessage());
    }
  }
}