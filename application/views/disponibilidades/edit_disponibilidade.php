<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">

          <form action="<?= site_url('disponibilidades/process_edit') ?>" method="POST" id="form">
            <h2>Disponibilidade</h2>
            <input type="hidden" value="<?= $this->disponibilidade->id ?>" name="id_disponibilidade">
            <div class="form-group">
              <label for="data_inicio">Data Inicio</label>
              <?= form_error('data_inicio', "<span class='help-block'>", "</span>")?>
              <div class="input-group date datepicker" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                <input type="text" class="form-control" name="disponibilidades[0][data_inicio]" value="<?= $this->disponibilidade->data_inicio ?><?= set_value('data_inicio'); ?>">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          
            <div class="form-group">
              <label for="data_fim">Data Fim</label>
              <?= form_error('data_fim', "<span class='help-block'>", "</span>")?>
              <div class="input-group date datepicker" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                <input type="text" class="form-control" name="disponibilidades[0][data_fim]" value="<?= $this->disponibilidade->data_fim ?><?= set_value('data_fim'); ?>">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>

            <div class="pull-right">
              <a href="#" onclick="window.history.back();" class="btn btn-danger">Cancelar</a>
              <button class="btn btn-success" type="submit">Actualizar</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>
