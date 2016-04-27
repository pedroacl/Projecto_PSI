<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">

          <form action="" method="POST" enctype="multipart/form-data" id="form">
            <h2>Registar Utilizador</h2>

            <div class="form-group <?= has_error('email') ?>">
              <?php echo form_error('email')?>
              <label for="inputEmail" class="control-label">Email</label>
              <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus value="<?php echo set_value('email'); ?>">
            </div>

            <div class="form-group <?= has_error('password') ?>">
              <?php echo form_error('password')?>
              <label class="control-label">Password</label>
              <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group <?= has_error('confirmacao_password') ?>">
              <?php echo form_error('confirmacao_password')?>
              <label class="control-label">Confirmação da Password</label>
              <input name="confirmacao_password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group <?= has_error('tipo_utilizador') ?>">
              <?php echo form_error('tipo_utilizador')?>
              <label class="control-label">Tipo de Utilizador</label>
              <select name="tipo_utilizador" id="tipo_utilizador_select" class="form-control"
                value="<?php echo set_value('tipo_utilizador'); ?>">
                <option id="default_utilizador_select" value="none" <?php echo set_select('tipo_utilizador', 'none'); ?>>-</option>
                <option id="voluntario_select" value="voluntario" <?php echo set_select('tipo_utilizador', 'voluntario') ?>>Voluntário</option>
                <option id="instituicao_select" value="instituicao" <?php echo set_select('tipo_utilizador', 'instituicao') ?>>Instituição</option>
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
                <?php echo form_error('nome_utilizador')?>
                <label class="control-label">Nome</label>
                <input name="nome_utilizador" value="<?php echo set_value('nome_utilizador'); ?>" class="form-control" placeholder="Nome Completo"></input>
              </div>

              <div class="form-group <?= has_error('genero') ?>">
                <?php echo form_error('genero')?>
                <label class="control-label">Género</label>
                <div class="checkbox">
                  <label class="radio-inline"><input type="radio" name="genero" value="m" <?php echo set_radio('genero', 'm'); ?>>Masculino</label>
                  <label class="radio-inline"><input type="radio" name="genero" value="f" <?php echo set_radio('genero', 'f'); ?>>Feminino</label>
                </div>
              </div>

              <div class="form-group <?= has_error('data_nascimento') ?>">
                <?php echo form_error('data_nascimento')?>
                <label class="control-label">Data de Nascimento</label>
                <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                  <input name="data_nascimento" value="<?php echo set_value('data_nascimento'); ?>" type='text' class="form-control" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                  </div>
              </div>


              <div class="form-group <?= has_error('telefone') ?>">
                <?php echo form_error('telefone')?>
                <label class="control-label">Telefone</label>
                <input name="telefone" value="<?php echo set_value('telefone'); ?>" class="form-control" placeholder="Telefone"></input>
              </div>

              <div class="form-group <?= has_error('grupos_atuacao[]') ?>">
                <?php echo form_error('grupos_atuacao[]')?>
                <label class="control-label">Grupo de Atuação</label>
                <select multiple class="form-control" name="grupos_atuacao[]">
                  <?php foreach ($this->grupos_atuacao->result() as $row) { ?>
                    <option value="<?php echo $row->id ?>" <?php echo set_select('grupos_atuacao[]', $row->id) ?>>
                      <?php echo $row->nome ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group <?= has_error('areas_interesse[]') ?>">
                <?php echo form_error('areas_interesse[]')?>
                <label class="control-label">Áreas de Interesse</label>
                <select multiple class="form-control" name="areas_interesse[]">
                  <?php foreach ($this->areas_interesse->result() as $row) { ?>
                    <option value="<?php echo $row->id ?>" <?php echo set_select('areas_interesse[]', $row->id) ?>>
                      <?php echo $row->nome ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <br>
              <h3>Área Geográfica</h3>

              <div class="form-group <?= has_error('concelho') ?>">
                <?php echo form_error('concelho')?>
                <label class="control-label">Concelho</label>
                <select id="concelho" class="form-control" name="concelho">
                  <option value="default">-</option>
                  <?php foreach ($this->select_boxes_data['concelho'] as $key => $value) { ?>
                    <option value="<?php echo $value ?>">
                      <?php echo $value ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group <?= has_error('distrito') ?>">
                <?php echo form_error('distrito')?>
                <label class="control-label">Distrito</label>
                <select id="distrito" class="form-control" name="distrito">
                  <option value="default">-</option>
                  <?php foreach ($this->select_boxes_data['districto'] as $key => $value) { ?>
                    <option value="<?php echo $value ?>">
                      <?php echo $value ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group <?= has_error('freguesia') ?>">
                <?php echo form_error('freguesia')?>
                <label class="control-label">Freguesia</label>
                <select id="freguesia" class="form-control" name="freguesia">
                  <option value="default">-</option>
                  <?php foreach ($this->select_boxes_data['freguesia'] as $key => $value) { ?>
                    <option value="<?php echo $value ?>">
                      <?php echo $value ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <br>
              <h3>Habilitações Académicas</h3>
              <div class="form-group <?= has_error('tipo_habilitacao_academica') ?>">
                <?php echo form_error('tipo_habilitacao_academica')?>
                <label class="control-label">Tipo</label>
                <select class="form-control" name="tipo_habilitacao_academica">
                    <?php foreach ($this->tipos_habilitacoes_academicas->result() as $row) { ?>
                      <option value="<?php echo $row->id ?>">
                        <?php echo $row->nome ?>
                      </option>
                    <?php } ?>
                </select>
              </div>

              <div class="form-group <?= has_error('curso') ?>">
                <?php echo form_error('curso')?>
                <label class="control-label">Curso</label>
                <input type="text" class="form-control" name="curso" value="<?php echo set_value('curso'); ?>">
              </div>

              <div class="form-group <?= has_error('instituto_ensino') ?>">
                <?php echo form_error('instituto_ensino')?>
                <label class="control-label">Instituto</label>
                <input type="text" class="form-control" name="instituto_ensino" value="<?php echo set_value('instituto_ensino'); ?>">
              </div>

              <div class="form-group <?= has_error('data_conclusao_curso') ?>">
                <?php echo form_error('data_conclusao_curso')?>
                <label class="control-label">Data de Conclusão</label>
                <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                  <input type='text' name='data_conclusao_curso' class="form-control" value="<?php echo set_value('data_conclusao_curso'); ?>"/>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>

              <br>
              <h3>Disponibilidade</h3>

              <table class="table" id="disponibilidade_table" style="display: none;">
                <tr>
                  <th>Data inicio</th>
                  <th>Data fim</th>
                  <th>Periodicidade</th>
                  <th>Repetir até</th>
                  <th>Acções</th>
                </tr>
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
                  <label class="radio-inline"><input type="radio" name="genero" value='m' <?php echo set_radio(''); ?>>Masculino</label>
                  <label class="radio-inline"><input type="radio" name="genero" value='f' <?php echo set_radio(''); ?>>>Feminino</label>
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



            <?php if (isset($this->disponibilidades)) { ?>
              <h3>Test</h3>

              <table id="disp_table" class="table">
                <tbody>
                  <tr>
                    <th>Data inicio</th>
                    <th>Data fim</th>
                    <th>Periodicidade</th>
                    <th>Repetir até</th>
                    <th>Acções</th>
                  </tr>
                  <?php foreach ($this->disponibilidades as $disponibilidade => $value) { ?>
                    <tr>
                      <td><?php echo $disponibilidade['data_inicio'] ?></td>
                      <td><?php echo $disponibilidade['data_fim'] ?></td>
                      <td><?php echo $disponibilidade['periodicidade'] ?></td>
                      <td><?php echo $disponibilidade['repetir_ate'] ?></td>
                  <?php } ?>
                </tbody>
              </table>
            <?php } ?>



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
