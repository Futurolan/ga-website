<?php
/**
* @file
* Contains \Drupal\test_twig\Controller\GaStreamController.
*/

namespace Drupal\ga_stream\Controller;

use Drupal\Core\Controller\ControllerBase;

class GaStreamController extends ControllerBase {
public function content() {

return array(
'#theme' => 'streamblock',
'#test_var' => $this->t('Test Value'),
);

}
}