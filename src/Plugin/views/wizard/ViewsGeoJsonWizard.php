<?php

namespace Drupal\views_geojson\Plugin\views\wizard;

use Drupal\views\Plugin\views\wizard\WizardPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Tests creating comment views with the wizard.
 *
 * @ViewsWizard(
 *   id = "views_geojson",
 *   base_table = "views_geojson",
 *   title = @Translation("Views GeoJSON")
 * )
 */
class ViewsGeoJsonWizard extends WizardPluginBase {
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['displays']['views_geojson_export'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Views GeoJSON export settings'),
      '#attributes' => array('class' => array('views-attachment', 'fieldset-no-legend')),
      '#tree' => TRUE,
    );
    $form['displays']['views_geojson_export']['create'] = array(
      '#title' => $this->t('Provide a REST export'),
      '#type' => 'checkbox',
      '#attributes' => array('class' => array('strong')),
      '#id' => 'edit-rest-export-create',
    );

    // All options for the REST export display are included in this container
    // so they can be hidden as a group when the "Provide a REST export"
    // checkbox is unchecked.
    $form['displays']['views_geojson_export']['options'] = array(
      '#type' => 'container',
      '#attributes' => array('class' => array('options-set')),
      '#states' => array(
        'visible' => array(
          ':input[name="views_geojson_export[create]"]' => array('checked' => TRUE),
        ),
      ),
      '#prefix' => '<div id="edit-rest-export-wrapper">',
      '#suffix' => '</div>',
      '#parents' => array('views_geojson_export'),
    );

    $form['displays']['views_geojson_export']['options']['path'] = array(
      '#title' => $this->t('REST export path'),
      '#type' => 'textfield',
      '#field_prefix' => $path_prefix,
      // Account for the leading backslash.
      '#maxlength' => 254,
    );
    return $form;
  }
}