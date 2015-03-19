<?php
/**
 * @file
 * Contains the BBOX query string argument default plugin.
 */

/**
 * The BBOX query string argument default handler.
 *
 * @TODO: Write an options_validate() method.
 */
class views_plugin_argument_default_bboxquery extends views_plugin_argument_default {
  function option_definition() {
    $options = parent::option_definition();
    $options['argument'] = array('default' => '');
    $options['arg_id'] = array('default' => 'bbox');

    return $options;
  }

  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    $form['info'] = array(
      '#markup' => '<p class="description">Attempt to pull bounding box info
      directly from the query string, bypassing Drupal\'s normal argument
      handling. If the argument does not exist, all values will be shown.</p>',
    );
    $form['arg_id'] = array(
      '#type' => 'textfield',
      '#title' => t('Query argument ID'),
      '#size' => 60,
      '#maxlength' => 64,
      '#default_value' => $this->options['arg_id'] ? $this->options['arg_id'] : t('bbox'),
      '#description' => t('The ID of the query argument.<br />For OpenLayers use <em>bbox</em>, (as in "<em>?bbox=left,bottom,right,top</em>".)'),
    );
  }

  /**
   * Return the default argument.
   */
  function get_argument() {
    // @TODO: Shouldn't we sanitize this user input?
    $query = drupal_get_query_parameters();
    if (isset($query[$this->options['arg_id']])) {
      return $query[$this->options['arg_id']];
    }
    else {
      // Return all values if arg not present.
      return TRUE;
    }
  }
}
