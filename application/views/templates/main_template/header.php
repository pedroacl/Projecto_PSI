<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="@Volunteer - Plataforma online onde os docentes e alunos da FCUL podem ajudar a fazer a diferença!">
    <meta name="author" content="Fcultos Altruistas">
    <link rel="icon" href="favicon.ico">

    <title><?= $this->title ?></title>

    <!-- Bootstrap core CSS -->

    <link href="<?= base_url('/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('/assets/css/application.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css') ?>" rel="stylesheet">

    <script src="<?= base_url('/assets/vendor/jquery-1.12.3.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/areas_geograficas.js') ?>"></script>
    <script src="<?= base_url('/assets/js/' . $this->js_file) ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php $class_if_not_loggedin = $this->session->userdata('id') !== null ? '' : 'toggled'; ?>
    <div class="wrapper <?= $class_if_not_loggedin ?>">
      <div class="sidebar-wrapper">
        <h3><a href="/">Volunteer @ FCUL</a></h3>
        <div class="image-holder">
          <img src="<?= base_url('/assets/images/logo.jpeg') ?>" alt="logo">
        </div>
        <nav>
          <ul>
            <li><a href="<?= site_url($this->user_profile_link) ?>">Perfil</a></li>
            <li><a href="#">Pesquisar</a></li>
            <li><a href="#">Instituições</a></li>
          </ul>
        </nav>

      </div>
      <div class="page-content-wrapper">
        <div class="container container-base">
          <div class="row">

            <div class="col-md-12">

              <nav class="navbar navbar-default navbar-static-top">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <a class="navbar-brand" href="/">@Volunteer FCUL</a>
                  </div>
                  <ul class="nav navbar-nav navbar-right">
                    <?php
                      if ($this->session->userdata('id') !== null) {
                        echo '<li><a href="' . site_url($this->user_profile_link) . '"</a>' . $this->nome_utilizador . '</li>';
                        echo '<li><a href="' . site_url("logout") . '">Logout</a></li>';
                      }
                      else {
                        echo "<li class='";
                        echo isset($this->login_tab) ? 'active' : '';
                        echo "'><a href='" . site_url("login") . "'>Login</a></li>";
                        echo "<li><a href='" . site_url("signup") . "'>Registar</a></li>";
                      }

                    ?>
                  </ul>
                </div>
              </nav>

              <div class="container-fluid">
                <?= show_flash($this) ?>
              </div>


