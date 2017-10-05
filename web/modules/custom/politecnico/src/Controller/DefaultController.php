<?php

namespace Drupal\politecnico\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\politecnico\Service\PolitecnicoService;

/**
 * Class DefaultController.
 */
class DefaultController extends ControllerBase {

  /**
   * Drupal\politecnico\Service\PolitecnicoService definition.
   *
   * @var \Drupal\politecnico\Service\PolitecnicoService
   */
  protected $politecnicoPolitecnico;

  /**
   * Constructs a new DefaultController object.
   */
  public function __construct(PolitecnicoService $politecnico_politecnico) {
    $this->politecnicoPolitecnico = $politecnico_politecnico;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('politecnico.politecnico')
    );
  }

  /**
   * Example.
   */
  public function example() {
    $items = $this->politecnicoPolitecnico->getData('000008');
    dpm($items);

    return [
      '#markup' => 'pippo',
    ];

//    return [
//      '#theme' => 'item_list',
//      '#list_type' => 'ul',
//      '#title' => 'My Recors',
//      '#items' => $items,
//    ];
  }

}
