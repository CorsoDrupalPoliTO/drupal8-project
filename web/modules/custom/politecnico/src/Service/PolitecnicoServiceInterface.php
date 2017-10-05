<?php

namespace Drupal\politecnico\Service;

/**
 * Interface PolitecnicoServiceInterface.
 *
 * @package Drupal\politecnico\Service
 */
interface PolitecnicoServiceInterface {

  /**
   * Return data from external table.
   *
   * @param string $matricola
   *
   * @return array
   */
  public function getData($matricola);

}