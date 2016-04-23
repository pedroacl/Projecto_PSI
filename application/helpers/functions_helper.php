<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
  function show_flash($controller)
  {
    $result = "";
    $types = array('success', 'danger', 'warning');

    foreach ($types as $type) {
      if ($controller->session->flashdata($type) !== null) {
        $result = $result . "<div class='alert alert-" . $type . "' role='alert' class='close'>" . $controller->session->flashdata($type);
        $result = $result . "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
        $result = $result . "</div>";
      }
    }

    return $result;
  }
}