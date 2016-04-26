<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">

          <form action="" method="POST" enctype="multipart/form-data">
            <h2>Registar Utilizador</h2>

            <div class="form-group">
              <label for="inputEmail" class="control-label">Email</label>
              <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus value="<?php echo set_value('email'); ?>">
            </div>

            <div class="form-group">
              <label class="control-label">Password</label>
              <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group">
              <label class="control-label">Confirmação da Password</label>
              <input name="password_confirmation" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group">
              <label class="control-label">Tipo de Utilizador</label>
              <select name="user_type" id="user_type_select" class="form-control"
                value="<?php echo set_value('user_type'); ?>">
                <option id="default_user_select" value="none" <?php echo set_select('user_type', 'none'); ?>>-</option>
                <option id="volunteer_select" value="volunteer" <?php echo set_select('user_type', 'volunteer') ?>>Voluntário</option>
                <option id="institution_select" value="institution" <?php echo set_select('user_type', 'institution') ?>>Instituição</option>
              </select>
            </div>

            <div id="user_form_end"></div>

            <!-- Campos de um Voluntario -->
            <div class="volunteer_fields" style="display: none;">

              <div class="form-group">
                <label class="control-label">Foto</label>
                <input type="file">
              </div>

              <div class="form-group <?= has_error('user_name') ?>" >
                <label class="control-label">Nome</label>
                <input name="user_name" value="<?php echo set_value('user_name'); ?>" class="form-control" placeholder="Nome Completo"></input>
              </div>

              <div class="form-group <?= has_error('gender') ?>">
                <label class="control-label">Género</label>
                <div class="checkbox">
                  <label class="radio-inline"><input type="radio" name="gender" value="m" <?php echo set_radio('gender', 'm'); ?>>Masculino</label>
                  <label class="radio-inline"><input type="radio" name="gender" value="f" <?php echo set_radio('gender', 'f'); ?>>Feminino</label>
                </div>
              </div>

              <div class="form-group <?= has_error('birthdate') ?>">
                <label class="control-label">Data de Nascimento</label>
                <div class='input-group date' data-provide="datepicker" class='datepicker'>
                  <input name="birthdate" value="<?php echo set_value('birthdate'); ?>" type='text' class="form-control" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                  </div>
              </div>


              <div class="form-group <?= has_error('phone_number') ?>">
                <label class="control-label">Telefone</label>
                <input name="phone_number" value="<?php echo set_value('phone_number'); ?>" class="form-control" placeholder="Telefone"></input>
              </div>

              <div class="form-group <?= has_error('action_groups') ?>">
                <label class="control-label">Grupo de Atuação</label>
                <select multiple class="form-control" name="action_groups[]">
                  <?php foreach ($this->action_groups->result() as $row) { ?>
                    <option value="<?php echo $row->id ?>" <?php echo set_select('action_groups[]', $row->id) ?>>
                      <?php echo $row->nome ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group <?= has_error('areas_of_interest') ?>">
                <label class="control-label">Áreas de Interesse</label>
                <select multiple class="form-control" name="areas_of_interest[]">
                  <?php foreach ($this->areas_of_interest->result() as $row) { ?>
                    <option value="<?php echo $row->id ?>" <?php echo set_select('areas_of_interest[]', $row->id) ?>>
                      <?php echo $row->nome ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <br>
              <h3>Área Geográfica</h3>

              <div class="form-group <?= has_error('conselho_vol') ?>">
                <label class="control-label">Concelho</label>
                <select id="concelho_vol" class="form-control" name="county">
                  <option value="default">-</option>
                  <?php foreach ($this->select_boxes_data['geographic_area_counties'] as $key => $value) { ?>
                    <option value="<?php echo $value ?>">
                      <?php echo $value ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group <?= has_error('distrito_vol') ?>">
                <label class="control-label">Distrito</label>
                <select id="distrito_vol" class="form-control" name="district">
                  <option value="default">-</option>
                  <?php foreach ($this->select_boxes_data['geographic_area_districts'] as $key => $value) { ?>
                    <option value="<?php echo $value ?>">
                      <?php echo $value ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group <?= has_error('freguesia_vol') ?>">
                <label class="control-label">Freguesia</label>
                <select id="freguesia_vol" class="form-control" name="parish">
                  <option value="default">-</option>
                  <?php foreach ($this->select_boxes_data['geographic_area_parishes'] as $key => $value) { ?>
                    <option value="<?php echo $value ?>">
                      <?php echo $value ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <br>
              <h3>Habilitações Académicas</h3>
              <div class="form-group <?= has_error('tipo_habilitacoes') ?>">
                <label class="control-label">Tipo</label>
                <select class="form-control" name="academic_qualification_type">
                    <?php foreach ($this->academic_qualifications_types->result() as $row) { ?>
                      <option value="<?php echo $row->id ?>">
                        <?php echo $row->nome ?>
                      </option>
                    <?php } ?>
                </select>
              </div>

              <div class="form-group <?= has_error('curso') ?>">
                <label class="control-label">Curso</label>
                <input type="text" class="form-control" name="academic_qualification_degree" value="<?php echo set_value('academic_qualification_degree'); ?>">
              </div>

              <div class="form-group <?= has_error('instituto') ?>">
                <label class="control-label">Instituto</label>
                <input type="text" class="form-control" name="academic_qualification_institute" value="<?php echo set_value('academic_qualification_institute'); ?>">
              </div>

              <div class="form-group <?= has_error('data_conclusao_habilitacoes') ?>">
                <label class="control-label">Data de Conclusão</label>
                <div class='input-group date' data-provide="datepicker" class='datepicker'>
                  <input type='text' name='academic_qualification_end_date' class="form-control" value="<?php echo set_value('academic_qualification_end_date'); ?>"/>
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

                      <div class='input-group date' data-provide="datepicker" class='datepicker'>
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

                      <div class='input-group date' data-provide="datepicker" class='datepicker'>
                        <input type="text" class="form-control" id="data_fim_disponibilidade">
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Repetir até</label>
                      <div class='input-group date' data-provide="datepicker" class='datepicker'>
                        <input type="text" class="form-control" id="repetir_ate_disponibilidade">
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                      </div>
                    </div>
                  </div>
                  <a id="add_new_disp" class="btn btn-primary bottom">Adicionar disponibilidade</a>
                </div>
              </div>
            </div>


            <!-- Campos de um Instituiçao -->

            <div class="institution_fields" style="display: none;">
              <div class="form-group">
                <label class="control-label">Nome</label>
                <input class="form-control" name="name" placeholder="Nome Completo" required></input>
              </div>

              <div class="form-group">
                <label class="control-label">Género</label>
                <div class="checkbox">
                  <label class="radio-inline"><input type="radio" name="gender" value='m' <?php echo set_radio(''); ?>>Masculino</label>
                  <label class="radio-inline"><input type="radio" name="gender" value='f' <?php echo set_radio(''); ?>>>Feminino</label>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">Telefone</label>
                <input class="form-control" name="telephone_number" required></input>
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
