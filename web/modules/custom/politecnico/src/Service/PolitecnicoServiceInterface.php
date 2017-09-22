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
   * @return array
   */
  public function getData();

}