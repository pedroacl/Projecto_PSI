<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">

          <form action="" method="POST" enctype="multipart/form-data" id="form">
            <h2>Editar Instituição</h2>

            <?php echo validation_errors() ?>

            <div class="form-group <?= has_error('nome_utilizador') ?>" >
              <label class="control-label">Nome</label>
              <?= form_error('nome_utilizador', "<span class='help-block'>", "</span>")?>
              <input name="nome_utilizador" value="<?= set_value('nome_utilizador', $this->instituicao_data->nome); ?>" class="form-control" placeholder="Nome Completo"></input>
            </div>

            <div class="form-group <?= has_error('descricao') ?>">
              <label class="control-label">Descricao</label>
              <?= form_error('descricao', "<span class='help-block'>", "</span>")?>
              <textarea name="descricao" class="form-control" placeholder="Descrição"><?= set_value('descricao', $this->instituicao_data->descricao); ?></textarea>
            </div>

            <div class="form-group <?= has_error('telefone') ?>">
              <label class="control-label">Telefone</label>
              <?= form_error('telefone', "<span class='help-block'>", "</span>")?>
              <input name="telefone" value="<?= set_value('telefone', $this->instituicao_data->telefone); ?>" class="form-control" placeholder="Telefone"></input>
            </div>

            <div class="form-group <?= has_error('morada') ?>">
              <label class="control-label">Morada</label>
              <?= form_error('morada', "<span class='help-block'>", "</span>")?>
              <input name="morada" value="<?= set_value('morada', $this->instituicao_data->morada); ?>" class="form-control" placeholder="Morada"></input>
            </div>

            <div class="form-group <?= has_error('website') ?>">
              <label class="control-label">Website</label>
              <?= form_error('website', "<span class='help-block'>", "</span>")?>
              <input name="website" value="<?= set_value('website', $this->instituicao_data->website); ?>" class="form-control" placeholder="Website"></input>
            </div>

            <div class="form-group <?= has_error('email_instituicao') ?>">
              <label class="control-label">Email de Instituição</label>
              <?= form_error('email_instituicao', "<span class='help-block'>", "</span>")?>
              <input name="email_instituicao" type="email" value="<?= set_value('email_instituicao', $this->instituicao_data->email_instituicao); ?>" class="form-control" placeholder="Email de Instituição"></input>
            </div>

            <br>
            <h3>Área Geográfica</h3>
            <div class="form-group <?= has_error('distrito') ?>">
              <label class="control-label">Distrito</label>
              <?= form_error('distrito', "<span class='help-block'>", "</span>")?>
              <select id="distrito" class="form-control" name="distrito">
                <option value="default">-</option>
                <? if ($this->area_geografica !== '') { ?>
                  <option value="<?= $this->area_geografica->distrito ?>" <?= set_select('distrito', $this->area_geografica_data->distrito, TRUE) ?>><?= $this->area_geografica->distrito ?></option>
                <? } ?>
              </select>
            </div>

            <div class="form-group <?= has_error('concelho') ?>">
              <label class="control-label">Concelho</label>
              <?= form_error('concelho', "<span class='help-block'>", "</span>")?>
              <select id="concelho" class="form-control" name="concelho">
                <option value="default">-</option>
                <? if ($this->area_geografica !== '') { ?>
                <option value="<?= $this->area_geografica->concelho ?>" <?= set_select('concelho', $this->area_geografica_data->concelho, TRUE) ?>><?= $this->area_geografica->concelho ?></option>
                <? } ?>
              </select>
            </div>

            <div class="form-group <?= has_error('freguesia') ?>">
              <label class="control-label">Freguesia</label>
              <?= form_error('freguesia', "<span class='help-block'>", "</span>")?>
              <select id="freguesia" class="form-control" name="freguesia">
                <option value="default">-</option>
                <? if ($this->area_geografica !== '') { ?>
                <option value="<?= $this->area_geografica->freguesia ?>" <?= set_select('freguesia', $this->area_geografica_data->freguesia, TRUE) ?>><?= $this->area_geografica->freguesia ?></option>
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
