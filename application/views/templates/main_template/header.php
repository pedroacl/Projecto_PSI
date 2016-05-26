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

    <?php
    if (isset($this->js_files)) {
      foreach ($this->js_files as $file) {
        echo "<script src='" . base_url('/assets/js/' . $file) . "'></script>";
      }
    } ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Volunteer @ FCUL
            <?php
              if (isset($this->tipo_utilizador) && ($this->tipo_utilizador == 'instituicao')) {
                echo ' - Instituição';
              }
              elseif (isset($this->tipo_utilizador) && ($this->tipo_utilizador == 'voluntario')) {
                echo ' - Voluntário';
              }
            ?>
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php
              if ($this->session->userdata('id_utilizador') !== null) {
                $this->nome_para_link = $this->nome_utilizador != '' ? $this->nome_utilizador : $this->email;
                echo '<li><a href="' . site_url($this->user_profile_link) . '"</a>' . $this->nome_para_link . '</li>';
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
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <?php
          $sidebar_class = '';
          $content_class = '';
          if ($this->session->userdata('id_utilizador') !== null) {
            $sidebar_class = 'col-sm-3 col-md-2';
            $content_class ='col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2';
          } else {
            $sidebar_class = 'toggled';
            $content_class ='col-sm-12 col-md-12';
          }

        ?>
        <div class="<?= $sidebar_class ?> sidebar">
          <h3><a href="<?= site_url('') ?>">Volunteer @ FCUL</a></h3>
          <div class="image-holder">
            <img src="<?= base_url('/assets/images/logo.jpeg') ?>" alt="logo">
          </div>
          <ul class="nav nav-sidebar">
            <li class="<?= $this->active_area == 'home' ? 'active' : '' ?>"><a href="<?= site_url('') ?>">Home</a></li>
            <li class="<?= $this->active_area == 'profile' ? 'active' : '' ?>"><a href="<?= site_url($this->user_profile_link) ?>">Perfil de <?php echo (isset($this->tipo_utilizador) && ($this->tipo_utilizador == 'instituicao') ? 'Instituição' : 'Voluntário') ?></a></li>
            <li class="<?= $this->active_area == 'pesquisa' ? 'active' : '' ?>"><a href="#">Pesquisar</a></li>
            <li class="<?= $this->active_area == 'instituicoes' ? 'active' : '' ?>"><a href="#">Instituições</a></li>
          </ul>
        </div>
        <div class="<?= $content_class ?> main">
          <div class="page-content-wrapper">
            <div class="container container-base">
                  <div class="container-fluid">
                    <?= show_flash($this) ?>
                  </div>



    <!-- <div class="wrapper <?= $class_if_not_loggedin ?>">
      <div class="sidebar-wrapper">

        <nav>

        </nav>

      </div>
      <div class="page-content-wrapper">
        <div class="container container-base">
          <div class="row">

            <div class="col-md-12">






 -->
