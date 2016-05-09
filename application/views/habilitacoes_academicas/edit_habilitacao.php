<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">

          <form action="<?= site_url('habilitacoes_academicas/process_edit') ?>" method="POST" id="form">
            <h2>Habilitações Académicas</h2>
            <div class="form-group <?= has_error('tipo_habilitacao_academica') ?>">
              <label class="control-label">Tipo</label>
              <?= form_error('tipo_habilitacao_academica', "<span class='help-block'>", "</span>")?>
              <select class="form-control" name="tipo_habilitacao_academica">
                  <?php foreach ($this->tipos_habilitacoes_academicas as $row) { ?>
                    <option value="<?= $row->id ?>">
                      <?= $row->nome ?>
                    </option>
                  <?php } ?>
              </select>
            </div>

            <div class="form-group <?= has_error('curso') ?>">
              <label class="control-label">Curso</label>
              <?= form_error('curso', "<span class='help-block'>", "</span>")?>
              <input type="text" class="form-control" name="curso" value="<?= $this->habilitacoes->curso ?><?= set_value('curso'); ?>">
            </div>

            <div class="form-group <?= has_error('instituto_ensino') ?>">
              <label class="control-label">Instituto</label>
              <?= form_error('instituto_ensino', "<span class='help-block'>", "</span>")?>
              <input type="text" class="form-control" name="instituto_ensino" value="<?= $this->habilitacoes->instituto_ensino ?><?= set_value('instituto_ensino'); ?>">
            </div>

            <div class="form-group <?= has_error('data_conclusao_curso') ?>">
              <label class="control-label">Data de Conclusão</label>
              <?= form_error('data_conclusao_curso', "<span class='help-block'>", "</span>")?>
              <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                <input type='text' name='data_conclusao_curso' class="form-control" value="<?= $this->habilitacoes->data_conclusao ?><?= set_value('data_conclusao_curso'); ?>"/>
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>

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
