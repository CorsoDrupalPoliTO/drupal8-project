<?php

namespace Drupal\politecnico\Plugin\views\argument_default;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\node\NodeInterface;
use Drupal\views\Plugin\views\argument_default\ArgumentDefaultPluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Default argumento for Gruppo di ricerca di una persona.
 *
 * @ViewsArgumentDefault(
 *   id = "politecnico_persona_gruppo_di_ricerca",
 *   title = @Translation("Gruppo di ricerca di una Persona")
 * )
 */
class PersonaGruppoDiRicerca extends ArgumentDefaultPluginBase {

  /**
   * The route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * PersonaGruppoDiRicerca constructor.
   *
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, RouteMatchInterface $route_match) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->routeMatch = $route_match;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_route_match')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getArgument() {
    if (($node = $this->routeMatch->getParameter('node')) && $node instanceof NodeInterface) {
      if ($node->hasField('field_gruppo_di_ricerca')
        && !$node->get('field_gruppo_di_ricerca')->isEmpty()) {
        return $node->get('field_gruppo_di_ricerca')->target_id;
      }
    }
  }

}
