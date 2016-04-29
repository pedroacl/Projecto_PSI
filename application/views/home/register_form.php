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


            <div class="voluntario_fields" style="display: none;">

              <div class="form-group <?= has_error('foto') ?>">
                <label class="control-label">Foto</label>
                <input type="file" name="foto"/>
              </div>

              <div class="form-group <?= has_error('nome_utilizador') ?>" >
                <label class="control-label">Nome</label>
                <?= form_error('nome_utilizador', "<span class='help-block'>", "</span>")?>
                <input name="nome_utilizador" value="<?= set_value('nome_utilizador'); ?>" class="form-control" placeholder="Nome Completo"></input>
              </div>

              <div class="form-group <?= has_error('genero') ?>">
                <label class="control-label">Género</label>
                <?= form_error('genero', "<span class='help-block'>", "</span>")?>
                <div class="checkbox">
                  <label class="radio-inline"><input type="radio" name="genero" value="m" <?= set_radio('genero', 'm'); ?>/>Masculino</label>
                  <label class="radio-inline"><input type="radio" name="genero" value="f" <?= set_radio('genero', 'f'); ?>/>Feminino</label>
                </div>
              </div>

              <div class="form-group <?= has_error('data_nascimento') ?>">
                <label class="control-label">Data de Nascimento</label>
                <?= form_error('data_nascimento', "<span class='help-block'>", "</span>")?>
                <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                  <input name="data_nascimento" value="<?= set_value('data_nascimento'); ?>" type='text' class="form-control" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                  </div>
              </div>


              <div class="form-group <?= has_error('telefone') ?>">
                <label class="control-label">Telefone</label>
                <?= form_error('telefone', "<span class='help-block'>", "</span>")?>
                <input name="telefone" value="<?= set_value('telefone'); ?>" class="form-control" placeholder="Telefone"></input>
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
                <input type="text" class="form-control" name="curso" value="<?= set_value('curso'); ?>">
              </div>

              <div class="form-group <?= has_error('instituto_ensino') ?>">
                <label class="control-label">Instituto</label>
                <?= form_error('instituto_ensino', "<span class='help-block'>", "</span>")?>
                <input type="text" class="form-control" name="instituto_ensino" value="<?= set_value('instituto_ensino'); ?>">
              </div>

              <div class="form-group <?= has_error('data_conclusao_curso') ?>">
                <label class="control-label">Data de Conclusão</label>
                <?= form_error('data_conclusao_curso', "<span class='help-block'>", "</span>")?>
                <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                  <input type='text' name='data_conclusao_curso' class="form-control" value="<?= set_value('data_conclusao_curso'); ?>"/>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>

              <br>
              <h3>Disponibilidade</h3>
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

            </div>


            <!-- Campos de um Instituiçao -->

            <div class="instituicao_fields" style="display: none;">
              <div class="form-group">
                <label class="control-label">Nome</label>
                <input class="form-control" name="name" placeholder="Nome Completo" required></input>
              </div>

              <div class="form-group">
                <label class="control-label">Género</label>
                <div class="checkbox">
                  <label class="radio-inline"><input type="radio" name="genero" value='<?= set_radio('genero', 'm'); ?>'>Masculino</label>
                  <label class="radio-inline"><input type="radio" name="genero" value='<?= set_radio('genero', 'f'); ?>'>Feminino</label>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">Telefone</label>
                <input class="form-control" name="teletelefone" required></input>
              </div>

              <div class="form-group">
                <label class="control-label">Concelho</label>
                <select id="concelho_inst" class="form-control" name="concelho_inst">
                  <option value="one">-</option>
                  <option value="one">Lisboa</option>
                  <option value="two">Leiria</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label">Distrito</label>
                <select id="distrito_inst" class="form-control" name="distrito_inst">
                  <option value="one">-</option>
                  <option value="one">Lisboa</option>
                  <option value="two">Leiria</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label">Freguesia</label>
                <select id="freguesia_inst" class="form-control" name="freguesia_inst">
                  <option value="one">-</option>
                  <option value="one">Lisboa</option>
                  <option value="two">Leiria</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label">Habilitações Académicas</label>
                <select class="form-control" name="message">
                  <option value="one">-</option>
                  <option value="">Licenciatura</option>
                  <option value="">Mestrado</option>
                </select>
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
