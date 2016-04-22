
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
    <script src="<?= base_url('/assets/js/home.js') ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">@Volunteer FCUL</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">About</a></li>
          <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Other Pets
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">My Pet 1</a></li>
                <li><a href="#">My Pet 2</a></li>
              </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
            // if ($this->is_logged_in()) {
            if ($this->session->userdata('id') !== null) {
              echo "<li><a href='logout'>Logout</a></li>";
            }
            else {
              echo "<li class='";
              echo isset($this->login_tab) ? 'active' : '';
              echo "'><a href='login'>Login</a></li>";
            }

          ?>
          <li><a href="#">Settings</a></li>
        </ul>
      </div>
    </nav>
