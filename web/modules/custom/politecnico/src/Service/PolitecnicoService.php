<?php

namespace Drupal\politecnico\Service;

use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class PolitecnicoService.
 *
 * @package Drupal\politecnico\Service
 */
class PolitecnicoService implements PolitecnicoServiceInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function getData() {

    $result_query = \Drupal::database()->select('users', 'u')
      ->fields('u', ['uid', 'uuid'])
      ->execute();
    $records = $result_query->fetchAll();

    foreach ($records as $record) {
      $items[$record->uid] = $record->uuid;
    }

    return $items;
  }

}
