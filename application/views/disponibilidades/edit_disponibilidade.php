<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">

          <form action="" method="POST" enctype="multipart/form-data" id="form">
            <h2>Disponibilidade</h2>
            <table id="disponibilidade_table" class="table">
              <tbody>
                <tr>
                  <th>Data inicio</th>
                  <th>Data fim</th>
                  <th>Periodicidade</th>
                  <th>Repetir até</th>
                  <th>Acções</th>
                </tr>

                <?php if (isset($this->disponibilidades)) {
                  $i = 0;
                  foreach ($this->disponibilidades as $key => $disponibilidade) { ?>
                    <tr id="disponibilidade_<?= $i; ?>">
                      <td><?= $disponibilidade['data_inicio'] ?></td>
                      <input type="hidden" name="disponibilidades[<?= $i ?>]['data_inicio']"/>

                      <td><?= $disponibilidade['data_fim'] ?></td>
                      <input type="hidden" name="disponibilidades[<?= $i ?>]['data_fim']"/>

                      <td><?= $disponibilidade['periodicidade'] ?></td>
                      <input type="hidden" name="disponibilidades[<?= $i ?>]['periodicidade']"/>

                      <td><?= $disponibilidade['repetir_ate'] ?></td>
                      <input type="hidden" name="disponibilidades[<?= $i ?>]['repetir_ate']"/>

                      <td><a class='btn btn-danger btn-sm eliminar'>Eliminar</a></td>
                    </tr>
                <?php
                    $i++;
                  }
                } ?>
              </tbody>
            </table>

            <br>
            <div class="well">
              <div class="row relative">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Data de Inicio</label>

                    <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                      <input type="text" class="form-control" id="data_inicio_disponibilidade">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Periodicidade</label>
                    <select id="periodicidade" class="form-control">
                      <option value="Semanalmente">Semanalmente</option>
                      <option value="Mensalmente">Mensalmente</option>
                      <option value="Anualmente">Anualmente</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Data de Fim</label>

                    <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                      <input type="text" class="form-control" id="data_fim_disponibilidade">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Repetir até</label>
                    <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                      <input type="text" class="form-control" id="repetir_ate_disponibilidade">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                </div>
                <a class="btn btn-primary bottom adicionar_disponibilidade">Adicionar disponibilidade</a>
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
