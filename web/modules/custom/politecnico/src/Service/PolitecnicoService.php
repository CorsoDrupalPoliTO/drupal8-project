<?php

namespace Drupal\politecnico\Service;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class PolitecnicoService.
 *
 * @package Drupal\politecnico\Service
 */
class PolitecnicoService implements PolitecnicoServiceInterface {

  use StringTranslationTrait;

  protected $connection;

  protected $cache;

  function __construct(Connection $connection, CacheBackendInterface $cache) {
    $this->connection = $connection;
    $this->cache = $cache;
  }

  /**
   * {@inheritdoc}
   */
  public function getData($matricola) {
    $cache = $this->cache->get('matricola_' . $matricola);

    if ($cache) {
      return $cache->data;
    }

    $result_query = $this->connection
      ->select('poli_anagrafica', 'p')
      ->fields('p', ['nominativo', 'email', 'sesso', 'sede'])
      ->condition('matricola', $matricola)
      ->execute();
    $records = $result_query->fetchAll(\PDO::FETCH_ASSOC);

    $this->cache->set('matricola_' . $matricola, $records, time() + 86400);

    return $records;
  }

}
