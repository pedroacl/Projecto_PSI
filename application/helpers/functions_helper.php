<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
  function show_flash($controller)
  {
    $result = "";
    $types = array('success', 'danger', 'warning');

    foreach ($types as $type) {
      $message = $controller->session->flashdata($type);
      if ($message !== null) {
        $result = $result . "<div class='alert alert-" . $type . "' role='alert' class='close'>";
        $result = $result . "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
        $result = $result . $message;
        $result = $result . "</div>";
      }
    }
    unset($_SESSION['__ci_vars']);
    return $result;
  }

  function has_error($field)
  {
    return form_error($field) !== '' ? 'has-error' : '';
  }
}