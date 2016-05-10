<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">

          <form action="" method="POST" enctype="multipart/form-data" id="form">
            <h2>Editar Voluntário</h2>

            <?php echo validation_errors() ?>

            <div class="form-group <?= has_error('foto') ?>">
              <label class="control-label">Foto</label>
              <input type="file" name="foto"/>
            </div>

            <div class="form-group <?= has_error('nome_utilizador') ?>" >
              <label class="control-label">Nome</label>
              <?= form_error('nome_utilizador', "<span class='help-block'>", "</span>")?>
              <input name="nome_utilizador" value="<?= set_value('nome_utilizador', $this->voluntario_data->nome); ?>" class="form-control" placeholder="Nome Completo"></input>
            </div>

            <div class="form-group <?= has_error('genero') ?>">
              <label class="control-label">Género</label>
              <?= form_error('genero', "<span class='help-block'>", "</span>")?>
              <div class="checkbox">
                <label class="radio-inline"><input type="radio" name="genero" value="m" <?= ($this->voluntario_data->genero === 'm' ? 'checked' : '') ?>/>Masculino</label>
                <label class="radio-inline"><input type="radio" name="genero" value="f" <?= ($this->voluntario_data->genero === 'f' ? 'checked' : '') ?>/>Feminino</label>
              </div>
            </div>

            <div class="form-group <?= has_error('data_nascimento') ?>">
              <label class="control-label">Data de Nascimento</label>
              <?= form_error('data_nascimento', "<span class='help-block'>", "</span>")?>
              <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                <input name="data_nascimento" value="<?= set_value('data_nascimento', $this->voluntario_data->data_nascimento); ?>" type='text' class="form-control" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>

            <div class="form-group <?= has_error('telefone') ?>">
              <label class="control-label">Telefone</label>
              <?= form_error('telefone', "<span class='help-block'>", "</span>")?>
              <input name="telefone" value="<?= set_value('telefone', $this->voluntario_data->telefone); ?>" class="form-control" placeholder="Telefone"></input>
            </div>

            <br>
            <h3>Área Geográfica</h3>

            <div class="form-group <?= has_error('distrito') ?>">
              <label class="control-label">Distrito</label>
              <?= form_error('distrito', "<span class='help-block'>", "</span>")?>
              <select id="distrito" class="form-control" name="distrito">
                <option value="default">-</option>
                <? if ($this->area_geografica !== '') { ?>
                  <option value="<?= $this->area_geografica->distrito ?>" <?= set_select('distrito', $this->area_geografica->distrito, TRUE) ?>><?= $this->area_geografica->distrito ?></option>
                <? } ?>
              </select>
            </div>

            <div class="form-group <?= has_error('concelho') ?>">
              <label class="control-label">Concelho</label>
              <?= form_error('concelho', "<span class='help-block'>", "</span>")?>
              <select id="concelho" class="form-control" name="concelho">
                <option value="default">-</option>
                <? if ($this->area_geografica !== '') { ?>
                <option value="<?= $this->area_geografica->concelho ?>" <?= set_select('concelho', $this->area_geografica->concelho, TRUE) ?>><?= $this->area_geografica->concelho ?></option>
                <? } ?>
              </select>
            </div>

            <div class="form-group <?= has_error('freguesia') ?>">
              <label class="control-label">Freguesia</label>
              <?= form_error('freguesia', "<span class='help-block'>", "</span>")?>
              <select id="freguesia" class="form-control" name="freguesia">
                <option value="default">-</option>
                <? if ($this->area_geografica !== '') { ?>
                <option value="<?= $this->area_geografica->freguesia ?>" <?= set_select('freguesia', $this->area_geografica->freguesia, TRUE) ?>><?= $this->area_geografica->freguesia ?></option>
                <? } ?>
              </select>
            </div>

            <br>

            <div class="pull-right">
              <a href="#" onclick="window.history.back();" class="btn btn-danger">Cancelar</a>
              <button class="btn btn-success" type="submit">Atualizar</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>
