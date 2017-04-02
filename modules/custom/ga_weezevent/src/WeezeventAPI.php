<?php

namespace Drupal\ga_weezevent;

class WeezeventAPI {
  private $base_uri = "https://api.weezevent.com";
  private $api_key = NULL;
  private $access_token = NULL;

  public function __construct($api_key, $access_token, $id_event) {
    $this->api_key = $api_key;
    $this->access_token = $access_token;
    $this->id_event = $id_event;
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

  public function ticket_info($id_ticket) {
    $client = \Drupal::httpClient();

    try {
      $response = $client->get('/tickets',
        array(
          'base_uri' => $this->base_uri,
          'query' => array(
            'api_key' => $this->api_key,
            'access_token' => $this->access_token,
            'id_event' => $this->id_event
          )
        )
      );
      $data = (string) $response->getBody();
      $result = \GuzzleHttp\json_decode($data);
      foreach ($result->events as $event) {
        foreach ($event->categories as $category) {
          foreach ($category->tickets as $ticket) {
            if ($ticket->id === $id_ticket) {
              return $ticket;
            }
          }
        }
      }
      watchdog_exception('ga_weezevent', "unknown id_ticket");

    } catch (RequestException $e) {
      watchdog_exception('ga_weezevent', $e->getMessage());
    } catch (InvalidArgumentException $e) {
      watchdog_exception('ga_weezevent', $e->getMessage());
    }
  }

  public function tickets() {
    $client = \Drupal::httpClient();

    try {
      $response = $client->get('/tickets',
        array(
          'base_uri' => $this->base_uri,
          'query' => array(
            'api_key' => $this->api_key,
            'access_token' => $this->access_token,
            'id_event' => $this->id_event
          )
        )
      );
      $data = (string) $response->getBody();
      $result = \GuzzleHttp\json_decode($data);
      foreach ($result->events as $event) {
        return $event;
      }

    } catch (RequestException $e) {
      watchdog_exception('ga_weezevent', $e->getMessage());
    } catch (InvalidArgumentException $e) {
      watchdog_exception('ga_weezevent', $e->getMessage());
    }
  }

}
	
