<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">
          
          <form action="" method="POST" enctype="multipart/form-data">
            <h2>Registar Voluntário</h2>
            <?php echo validation_errors(); ?>

            <div class="form-group">
              <label for="inputEmail" class="control-label">Email</label>
              <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
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
              <select name="user_type" id="user_type_select" class="form-control">
                <option id="default_user_select" value="none" selected>-</option>
                <option id="volunteer_select" value="volunteer">Voluntário</option>
                <option id="institution_select" value="institution">Instituição</option>
              </select>
            </div>

            <div id="user_form_end"></div>

            <!-- Campos de um Voluntario -->
            <div class="volunteer_fields">

              <div class="form-group">
                <label class="control-label">Foto</label>
                <input type="file">
              </div>

              <div class="form-group">
                <label class="control-label">Nome</label>
                <input name="name" class="form-control" placeholder="Nome Completo"></input>
              </div>

              <div class="form-group">
                <label class="control-label">Género</label>
                <div class="checkbox">
                  <label class="radio-inline"><input type="radio" name="gender" value="m">Masculino</label>
                  <label class="radio-inline"><input type="radio" name="gender" value="f">Feminino</label>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">Data de Nascimento</label>
                <div class='input-group date' data-provide="datepicker" class='datepicker'>
                  <input type='text' class="form-control" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                  </div>
              </div>


              <div class="form-group">
                <label class="control-label">Telefone</label>
                <input name="phone_number" class="form-control" placeholder="Telefone"></input>
              </div>

              <div class="form-group">
                <label class="control-label">Concelho</label>
                <select id="concelho_vol" class="form-control" name="concelho_vol">
                  <option value="one">-</option>
                  <option value="one">Lisboa</option>
                  <option value="two">Leiria</option>
                  <?php foreach ($this->data->geographic_areas as $geographic_area) { ?>
                    <option value="<?php echo $geographic_area->key ?>">
                      <?php echo $geographic_area->value ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label">Distrito</label>
                <select id="distrito_vol" class="form-control" name="distrito_vol">
                  <option value="one">-</option>
                  <option value="one">Lisboa</option>
                  <option value="two">Leiria</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label">Freguesia</label>
                <select id="freguesia_vol" class="form-control" name="freguesia_vol">
                  <option value="one">-</option>
                  <option value="one">Lisboa</option>
                  <option value="two">Leiria</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label">Grupo de Atuação</label>
                <select multiple class="form-control" name="grupo_atuacao">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label">Áreas de Interesse</label>
                <select multiple class="form-control" name="areas_interesse">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>

              <br>
              <h3>Habilitações Académicas</h3>
              <div class="form-group">
                <label class="control-label">Tipo</label>
                <select class="form-control" name="tipo_habilitacoes">
                    <option value="one">-</option>
                    <?php foreach ($this->data['academic_qualifications'] as $key => $value) { ?>
                      <option value="<?php echo $key ?>">
                        <?php echo $value ?>
                      </option>
                    <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Curso</label>
                <input type="text" class="form-control" name="curso">
              </div>
              <div class="form-group">
                <label class="control-label">Instituto</label>
                <input type="text" class="form-control" name="instituto">
              </div>
              <div class="form-group">
                <label class="control-label">Data de conclusão</label>
                <input type="text" class="form-control" name="data_conclusao_habilitacoes">
              </div>

              <br>
              <h3>Disponibilidade</h3>

              <table class="table">
                <tr>
                  <th>Data inicio</th>
                  <th>Data fim</th>
                  <th>Periodicidade</th>
                  <th>Repetir até</th>
                  <th>Acções</th>
                </tr>
                <tr>
                  <td>Data inicio</td>
                  <td>Data fim</td>
                  <td>Periodicidade</td>
                  <td>Repetir até</td>
                  <td><a href="#" class="btn btn-danger btn-sm">Eliminar</a></td>
                </tr>
              </table>

              <br>
              <div class="well">
                <div class="row relative">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Data de Inicio</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Periodicidade</label>
                      <input type="text" class="form-control" name="periodicidade">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Data de Inicio</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Repetir até</label>
                      <input type="text" class="form-control" name="repetir_ate">
                    </div>
                  </div>
                  <a href="#" class="btn btn-primary bottom">Adicionar disponibilidade</a>
                </div>
              </div>
            </div>
              

            <!-- Campos de um Instituiçao -->

            <div class="institution_fields">
              <div class="form-group">
                <label class="control-label">Nome</label>
                <input class="form-control" name="name" placeholder="Nome Completo" required></input>
              </div>

              <div class="form-group">
                <label class="control-label">Género</label>
                <div class="checkbox">
                  <label class="radio-inline"><input type="radio" name="gender" value="m">Masculino</label>
                  <label class="radio-inline"><input type="radio" name="gender" value="f">Feminino</label>
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
