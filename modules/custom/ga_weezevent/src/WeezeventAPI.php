<?php

namespace Drupal\ga_weezevent;

class WeezeventAPI {
  private $base_uri = "https://api.weezevent.com";
  private $api_key = NULL;
  private $access_token = NULL;

  public function __construct($api_key, $access_token) {
    $this->api_key = $api_key;
    $this->access_token = $access_token;
  }

  public function participants($id_event, $id_ticket) {
    $client = \Drupal::httpClient();

    try {
      $response = $client->get('/participants',
        array(
          'base_uri' => $this->base_uri,
          'query' => array(
            'api_key' => $this->api_key,
            'access_token' => $this->access_token,
            'id_event[]' => $id_event,
            'id_ticket[]' => $id_ticket
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