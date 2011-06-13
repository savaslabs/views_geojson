<?php

/**
 * @file views_geojson.views.inc
 * Views plugin definition.
 */

/**
 * Implements hook_views_plugins()
 * Adds GeoJSON feed style to views UI.
 */
function views_geojson_views_plugins() {
  return array(
    'style' => array(
      'views_geojson' => array(
        'title' => t('GeoJSON Feed'),
        'help' => t('Displays nodes in the GeoJSON data format.'),
        'handler' => 'views_plugin_style_geojson',
        'theme' => 'views_view_geojson',
        'theme path' => drupal_get_path('module', 'views_geojson') .'/views',
        'path' => drupal_get_path('module', 'views_geojson') .'/views',
        'uses row plugin' => FALSE,
        'uses fields' => TRUE,
        'uses options' => TRUE,
        'uses grouping' => FALSE,
        'type' => 'feed',
      ),
    ),
  );
}