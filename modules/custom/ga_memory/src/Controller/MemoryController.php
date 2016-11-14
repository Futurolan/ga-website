<?php

namespace Drupal\ga_memory\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ga_memory\MemoryUtils;

class MemoryController extends ControllerBase {
  public function render() {
    $config = MemoryUtils::getConfiguration();
    $memories = MemoryUtils::getMemories();
    return array(
      '#theme' => "ga_memory",
      '#config' => $config,
      '#memories' => $memories
    );
  }

}