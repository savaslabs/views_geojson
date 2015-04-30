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

    $form['displays']['views_geojson'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Views GeoJSON settings'),
      '#attributes' => array('class' => array('views-attachment', 'fieldset-no-legend')),
      '#tree' => TRUE,
    );
    $form['displays']['views_geojson_export']['create'] = array(
      '#title' => $this->t('Create a geoJSON view'),
      '#type' => 'checkbox',
      '#attributes' => array('class' => array('strong')),
      '#id' => 'edit-views-geojson-create',
    );

    // All options for the views geoJSON display are included in this container
    // so they can be hidden as a group when the "Create a geoJSON view"
    // checkbox is unchecked.
    $form['displays']['views_geojson']['options'] = array(
      '#type' => 'container',
      '#attributes' => array('class' => array('options-set')),
      '#states' => array(
        'visible' => array(
          ':input[name="views_geojson[create]"]' => array('checked' => TRUE),
        ),
      ),
      '#prefix' => '<div id="edit-views-geojson-wrapper">',
      '#suffix' => '</div>',
      '#parents' => array('views_geojson'),
    );

//    $form['displays']['views_geojson']['options']['path'] = array(
//      '#title' => $this->t('Views GeoJSON path'),
//      '#type' => 'textfield',
//      '#field_prefix' => $path_prefix,
//      // Account for the leading backslash.
//      '#maxlength' => 254,
//    );


    return $form;
  }
}