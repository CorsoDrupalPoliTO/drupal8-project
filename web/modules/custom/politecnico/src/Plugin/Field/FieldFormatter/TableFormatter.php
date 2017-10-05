<?php

namespace Drupal\politecnico\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Plugin\Field\FieldFormatter\FileFormatterBase;

/**
 * Plugin implementation of the 'file_table' formatter.
 *
 * @FieldFormatter(
 *   id = "politecnico_file_table",
 *   label = @Translation("Table of files for Politecnico"),
 *   field_types = {
 *     "file"
 *   }
 * )
 */
class TableFormatter extends FileFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    if ($files = $this->getEntitiesToView($items, $langcode)) {
      $header = [t('Attachment'), t('Size')];
      $rows = [];
      foreach ($files as $delta => $file) {

        $file->filename->set(0, $this->getSetting('label'));

        $rows[] = [
          [
            'data' => [
              '#theme' => 'file_link',
              '#file' => $file,
              '#cache' => [
                'tags' => $file->getCacheTags(),
              ],
            ],
          ],
          ['data' => format_size($file->getSize())],
        ];
      }

      $elements[0] = [];
      if (!empty($rows)) {
        $elements[0] = [
          '#theme' => 'table__file_formatter_table',
          '#header' => $header,
          '#rows' => $rows,
        ];
      }
    }

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
        'label' => 'CV',
      ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['label'] = [
      '#title' => t('Label'),
      '#type' => 'textfield',
      '#default_value' => $this->getSetting('label'),
    ];

    return $element;
  }

  public function settingsSummary() {
    $summary = [];
    $summary[] = 'Label: ' . $this->getSetting('label');
    return $summary;
  }

}
