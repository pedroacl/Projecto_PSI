<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">

          <form action="" method="POST" enctype="multipart/form-data" id="form">
            <h2>Registar Utilizador</h2>

            <div class="form-group <?= has_error('email') ?>">
              <label for="inputEmail" class="control-label">Email</label>
              <?= form_error('email', "<span class='help-block'>", "</span>")?>
              <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus value="<?= set_value('email'); ?>">
            </div>

            <div class="form-group <?= has_error('password') ?>">
              <label class="control-label">Password</label>
              <?= form_error('password', "<span class='help-block'>", "</span>")?>
              <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group <?= has_error('confirmacao_password') ?>">
              <label class="control-label">Confirmação da Password</label>
              <?= form_error('confirmacao_password', "<span class='help-block'>", "</span>")?>
              <input name="confirmacao_password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group <?= has_error('tipo_utilizador') ?>">
              <label class="control-label">Tipo de Utilizador</label>
              <?= form_error('tipo_utilizador', "<span class='help-block'>", "</span>")?>
              <select name="tipo_utilizador" id="tipo_utilizador_select" class="form-control"
                value="<?= set_value('tipo_utilizador'); ?>">
                <option id="default_utilizador_select" value="none" <?= set_select('tipo_utilizador', 'none'); ?>>-</option>
                <option id="voluntario_select" value="voluntario" <?= set_select('tipo_utilizador', 'voluntario') ?>>Voluntário</option>
                <option id="instituicao_select" value="instituicao" <?= set_select('tipo_utilizador', 'instituicao') ?>>Instituição</option>
              </select>
            </div>

            <div id="utilizador_form_end"></div>


            <!-- Campos de um Voluntario -->

            <?php $this->load->view('voluntarios/_form.php'); ?>

            <!-- Campos de um Instituiçao -->
            <?php $this->load->view('instituicoes/_form.php'); ?>


            <div class="pull-right">
              <a href="#" onclick="window.history.back();" class="btn btn-danger">Cancelar</a>
              <button class="btn btn-success" type="submit">Registar</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>
