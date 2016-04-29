<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">

          <form action="" method="POST" enctype="multipart/form-data" id="form">
            <h2>Registar Utilizador</h2>

            <!-- Campos de um Voluntario -->

            <div class="voluntario_fields">

              <div class="form-group <?= has_error('foto') ?>">
                <label class="control-label">Foto</label>
                <input type="file" name="foto"/>
              </div>

              <div class="form-group <?= has_error('nome_utilizador') ?>" >
                <label class="control-label">Nome</label>
                <?= form_error('nome_utilizador', "<span class='help-block'>", "</span>")?>
                <input name="nome_utilizador" value="<?= set_value('nome_utilizador', $this->voluntario->nome); ?>" class="form-control" placeholder="Nome Completo"></input>
              </div>

              <div class="form-group <?= has_error('genero') ?>">
                <label class="control-label">Género</label>
                <?= form_error('genero', "<span class='help-block'>", "</span>")?>
                <div class="checkbox">
                  <label class="radio-inline"><input type="radio" name="genero" value="m" <?= ($this->voluntario->genero === 'm' ? 'checked' : '') ?>/>Masculino</label>
                  <label class="radio-inline"><input type="radio" name="genero" value="f" <?= ($this->voluntario->genero === 'f' ? 'checked' : '') ?>/>Feminino</label>
                </div>
              </div>

              <div class="form-group <?= has_error('data_nascimento') ?>">
                <label class="control-label">Data de Nascimento</label>
                <?= form_error('data_nascimento', "<span class='help-block'>", "</span>")?>
                <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                  <input name="data_nascimento" value="<?= set_value('data_nascimento', $this->voluntario->data_nascimento); ?>" type='text' class="form-control" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                  </div>
              </div>

              <div class="form-group <?= has_error('telefone') ?>">
                <label class="control-label">Telefone</label>
                <?= form_error('telefone', "<span class='help-block'>", "</span>")?>
                <input name="telefone" value="<?= set_value('telefone', $this->voluntario->telefone); ?>" class="form-control" placeholder="Telefone"></input>
              </div>

              <div class="form-group <?= has_error('grupos_atuacao[]') ?>">
                <label class="control-label">Grupo de Atuação</label>
                <?= form_error('grupos_atuacao[]', "<span class='help-block'>", "</span>")?>
                <select multiple class="form-control" name="grupos_atuacao[]">
                  <?php foreach ($this->grupos_atuacao->result() as $row) { ?>
                    <option value="<?= $row->id ?>" <?= set_select('grupos_atuacao[]', $row->id) ?>>
                      <?= $row->nome ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group <?= has_error('areas_interesse[]') ?>">
                <label class="control-label">Áreas de Interesse</label>
                <?= form_error('areas_interesse[]', "<span class='help-block'>", "</span>")?>
                <select multiple class="form-control" name="areas_interesse[]">
                  <?php foreach ($this->areas_interesse->result() as $row) { ?>
                    <option value="<?= $row->id ?>" <?= set_select('areas_interesse[]', $row->id) ?>>
                      <?= $row->nome ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <br>
              <h3>Área Geográfica</h3>

              <div class="form-group <?= has_error('distrito') ?>">
                <label class="control-label">Distrito</label>
                <?= form_error('distrito', "<span class='help-block'>", "</span>")?>
                <select id="distrito" class="form-control" name="distrito">
                  <option value="default">-</option>
                </select>
              </div>

              <div class="form-group <?= has_error('concelho') ?>">
                <label class="control-label">Concelho</label>
                <?= form_error('concelho', "<span class='help-block'>", "</span>")?>
                <select id="concelho" class="form-control" name="concelho">
                  <option value="default">-</option>
                </select>
              </div>

              <div class="form-group <?= has_error('freguesia') ?>">
                <label class="control-label">Freguesia</label>
                <?= form_error('freguesia', "<span class='help-block'>", "</span>")?>
                <select id="freguesia" class="form-control" name="freguesia">
                  <option value="default">-</option>
                </select>
              </div>

              <br>
              <h3>Habilitações Académicas</h3>
              <div class="form-group <?= has_error('tipo_habilitacao_academica') ?>">
                <label class="control-label">Tipo</label>
                <?= form_error('tipo_habilitacao_academica', "<span class='help-block'>", "</span>")?>
                <select class="form-control" name="tipo_habilitacao_academica">
                    <?php foreach ($this->tipos_habilitacoes_academicas->result() as $row) { ?>
                      <option value="<?= $row->id ?>">
                        <?= $row->nome ?>
                      </option>
                    <?php } ?>
                </select>
              </div>

              <div class="form-group <?= has_error('curso') ?>">
                <label class="control-label">Curso</label>
                <?= form_error('curso', "<span class='help-block'>", "</span>")?>
                <input type="text" class="form-control" name="curso" value="<?= set_value('curso', $this->habilitacoes_academicas->curso); ?>">
              </div>

              <div class="form-group <?= has_error('instituto_ensino') ?>">
                <label class="control-label">Instituto</label>
                <?= form_error('instituto_ensino', "<span class='help-block'>", "</span>")?>
                <input type="text" class="form-control" name="instituto_ensino" value="<?= set_value('instituto_ensino', $this->habilitacoes_academicas->instituto_ensino) ?>">
              </div>

              <div class="form-group <?= has_error('data_conclusao_curso') ?>">
                <label class="control-label">Data de Conclusão</label>
                <?= form_error('data_conclusao_curso', "<span class='help-block'>", "</span>")?>
                <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                  <input type='text' name='data_conclusao_curso' class="form-control" value="<?= set_value('data_conclusao_curso', $this->habilitacoes_academicas->data_conclusao); ?>"/>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
            </div>

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
