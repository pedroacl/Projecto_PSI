<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
  function show_flash($controller)
  {
    $result = '';
    $types = array('success', 'error', 'warning');

    foreach ($types as $type) {
      if ($controller->session->flashdata($type) != null) {
        $result += '<div class="alert alert-' + $type + '" role="alert">' + $controller->session->flashdata($type) + '</div>';
      }
    }
    return $result;
  }
}