<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">

          <form action="<?= site_url('disponibilidades/process_edit') ?>" method="POST" enctype="multipart/form-data" id="form">
            <h2>Disponibilidade</h2>
            
            <div class="form-group">
              <label for="data_inicio">Data Inicio</label>
              <?= form_error('data_inicio', "<span class='help-block'>", "</span>")?>
              <div class="input-group date datepicker" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                <input type="text" class="form-control" name='data_inicio' value="<?= $this->disponibilidade->data_inicio ?> <?= set_value('data_inicio'); ?>">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          
            <div class="form-group">
              <label for="data_fim">Data Fim</label>
              <?= form_error('data_fim', "<span class='help-block'>", "</span>")?>
              <div class="input-group date datepicker" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                <input type="text" class="form-control" name='data_fim' value="<?= $this->disponibilidade->data_fim ?> <?= set_value('data_fim'); ?>">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>

            <div class="form-group">
              <label for="periodicidade">Periodicidade</label>
              <?= form_error('periodicidade', "<span class='help-block'>", "</span>")?>
              <select name="periodicidade" class="form-control">
                <option value="UmaVez" <?= set_select('periodicidade', 'UmaVez'); ?>>Uma única vez</option>
                <option value="Semanalmente" <?= set_select('periodicidade', 'Semanalmente'); ?>>Semanalmente</option>
                <option value="Mensalmente" <?= set_select('periodicidade', 'Mensalmente'); ?>>Mensalmente</option>
                <option value="Anualmente" <?= set_select('periodicidade', 'Anualmente'); ?>>Anualmente</option>
              </select>
            </div>

            <div class="form-group">
              <label for="data_fim_periodicidade">Repetir até</label>
              <?= form_error('data_fim_periodicidade', "<span class='help-block'>", "</span>")?>
              <div class="input-group date datepicker" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                <input type="text" class="form-control" name='data_fim_periodicidade' value="<?= $this->disponibilidade->data_fim_periodicidade ?> <?= set_value('data_fim_periodicidade'); ?>">
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
