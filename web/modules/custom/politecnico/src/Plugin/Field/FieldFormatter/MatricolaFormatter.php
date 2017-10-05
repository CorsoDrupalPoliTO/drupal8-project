<?php

namespace Drupal\politecnico\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\politecnico\Service\PolitecnicoServiceInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @FieldFormatter(
 *   id = "matricola_formatter",
 *   label = @Translation("Matricola Formatter"),
 *   field_types = {
 *     "string"
 *   }
 * )
 */
class MatricolaFormatter extends FormatterBase implements ContainerFactoryPluginInterface {

  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, PolitecnicoServiceInterface $politecnico) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);

    $this->politecnico = $politecnico;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('politecnico.politecnico')
    );
  }

  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $key => $item) {
      $matricola = $item->value;
      $data = $this->politecnico->getData($matricola);

      $elements[$key] = [
        '#theme' => 'persona',
        '#persona' => $data[0],
      ];
    }
    return $elements;
  }
}
