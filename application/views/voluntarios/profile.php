<div class="container-fluid content">
  <div class="row">
    <div class="col-md-12">

      <div class="panel panel-default">
        <div class="panel-body profile-voluntario">
          <div class="row">
            <div class="col-md-4">
              <div class="profile-photo-container">
                <a href="#" class="thumbnail">
                  <img src="<?= base_url($this->voluntario->foto) ?>">
                </a>
              </div>
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                  <h1><?= $this->voluntario->nome ?></h1>
                  <dl class="dl-horizontal">
                    <dt>Telefone</dt>
                    <dd><?= $this->voluntario->telefone ?></dd>

                    <dt>Género</dt>
                    <dd><?= ($this->voluntario->genero == 'm' ? 'Masculino' : 'Feminino'); ?></dd>

                    <dt>Data de Nascimento</dt>
                    <dd><?= $this->voluntario->data_nascimento ?></dd>

                    <dt>Email</dt>
                    <dd><?= $this->voluntario->email ?></dd>

                    <?php if($this->area_geografica->row() != null) { ?>
                      <dt>Distrito</dt>
                      <dd><?= $this->area_geografica->distrito ?></dd>

                      <dt>Concelho</dt>
                      <dd><?= $this->area_geografica->concelho ?></dd>

                      <dt>Freguesia</dt>
                      <dd><?= $this->area_geografica->freguesia ?></dd>
                    <?php } ?>
                  </dl>
                  <a class="btn btn-warning" href="<?= site_url('voluntarios/edit_profile') ?>">Editar Perfil</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6" id="edit_grupos_atuacao">
              <h4>Grupos de atuação <a class="btn btn-warning btn-sm">Editar</a></h4>
              <ul>
                <?php foreach ($this->grupos_atuacao_utilizador->result() as $grupos_atuacao_utilizador) {
                  echo '<li>' . $grupos_atuacao_utilizador->nome . ' <a class="btn btn-danger btn-sm" style="display: none;" href="' . site_url('grupos_atuacao/delete/' . $grupos_atuacao_utilizador->id) . '">&#10005;</a></li>';
                } ?>
              </ul>
              <?= form_open('grupos_atuacao/add/', array('class' => 'form-inline', 'style' => 'display: none;')) ?>
                <select name="id_grupo_atuacao" class="form-control">
                  <?php foreach ($this->tipos_grupos_atuacao->result() as $tipo_grupo_atuacao) {
                    echo '<option value="' . $tipo_grupo_atuacao->id . '">' . $tipo_grupo_atuacao->nome . '</option>';
                  } ?>
                </select>
                <input class="btn btn-primary btn-sm" type="submit" value="Adicionar"/>
              <?= form_close() ?>
            </div>

            <div class="col-md-6" id="edit_areas_interesse">
              <h4>Areas de Interesse <a class="btn btn-warning btn-sm">Editar</a></h4>
              <ul>
                <?php foreach ($this->areas_interesse_utilizador->result() as $area_interesse_utilizador) {
                    echo '<li>' . $area_interesse_utilizador->nome . ' <a class="btn btn-danger btn-sm" style="display: none;" href="' . site_url('areas_interesse/delete/' . $area_interesse_utilizador->id) . '">&#10005;</a></li>';
                } ?>
              </ul>

              <?= form_open('areas_interesse/add/', array('class' => 'form-inline', 'style' => 'display: none;')) ?>
                <select class="form-control" name="id_area_interesse">
                  <?php foreach ($this->tipos_areas_interesse->result() as $tipo_area_interesse) {
                    echo '<option value="' . $tipo_area_interesse->id . '">' . $tipo_area_interesse->nome . '</option>';
                  } ?>
                </select>
                <input class="btn btn-primary btn-sm" type="submit" value="Adicionar"/>
              <?= form_close() ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12" id="edit_habilitacoes">
              <h4>Habilitações Académicas <a class="btn btn-warning btn-sm">Editar</a></h4>
              <table class="table">
                <tbody>
                  <tr>
                    <th>Nome</th>
                    <th>Curso</th>
                    <th>Instituto</th>
                    <th>Data Conclusao</th>
                    <th class="actions" style="display: none;">Acções</th>
                  </tr>
                  <?php
                    foreach ($this->habilitacoes_academicas->result() as $habilitacao_academica)
                    {
                      echo '<tr>';
                      echo '<td>' . $habilitacao_academica->nome . '</td>';
                      echo '<td>' . $habilitacao_academica->curso . '</td>';
                      echo '<td>' . $habilitacao_academica->instituto_ensino . '</td>';
                      echo '<td>' . date("d/m/Y", strtotime($habilitacao_academica->data_conclusao)) . '</td>';
                      echo "<td class='actions' style='display: none;'><a class='btn btn-warning btn-sm' href='" . site_url("habilitacoes_academicas/edit/" . $habilitacao_academica->id) . "'>Editar</a><a class='btn btn-danger btn-sm' href='" . site_url("habilitacoes_academicas/delete/" . $habilitacao_academica->id) . "'>Eliminar</a></td>";
                      echo '</tr>';
                    }
                  ?>
                    <tr style="display: none;" id="form_add">
                      <?= form_open('habilitacoes_academicas/add/' . $this->session->userdata('id')) ?>
                        <td>
                          <?php
                            echo '<select class="form-control" name="tipo_habilitacao_academica">';
                            foreach ($this->tipos_habilitacoes_academicas->result() as $row) {
                              echo '<option value="' . $row->id . '">';
                              echo $row->nome;
                              echo '</option>';
                            }
                            echo '</select>';
                          ?>
                        </td>
                        <td><input class="form-control" name="curso"/></td>
                        <td><input class="form-control" name="instituto_ensino"/></td>
                        <td><input class="form-control" name="data_conclusao"/></td>
                        <td><input class="btn btn-primary btn-sm" type="submit" value="Adicionar"/></td>
                      <?= form_close() ?>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12" id="edit_disponibilidades">
              <h4>Disponibilidades <a class="btn btn-warning btn-sm">Editar</a></h4>
              <?php if((isset($this->disponibilidades)) && ($this->disponibilidades->num_rows() > 0)) { ?>

              <?php } else { ?>
                <h2>Não existem disponibilidades adicionadas</h2>
              <?php } ?>
              <table class="table">
                <tbody>
                  <tr>
                    <th>Data de Inicio</th>
                    <th>Data de Fim</th>
                    <th>Periodicidade</th>
                    <th>Repetir até</th>
                    <th class="actions" style="display: none;">Acções</th>
                  </tr>
                  <?php
                    foreach ($this->disponibilidades->result() as $disponibilidade) {
                      echo '<tr>';
                      echo '<td>' . date("d/m/Y", strtotime($disponibilidade->data_inicio)) . '</td>';
                      echo '<td>' . date("d/m/Y", strtotime($disponibilidade->data_fim)) . '</td>';
                      echo '<td>' . $disponibilidade->tipo_periodicidade . '</td>';
                      echo '<td>' . date("d/m/Y", strtotime($disponibilidade->data_fim_periodicidade)) . '</td>';
                      echo "<td class='actions' style='display: none;'><a class='btn btn-warning btn-sm' href='" . site_url("disponibilidades/edit/" . $disponibilidade->id) . "'>Editar</a><a class='btn btn-danger btn-sm' href='" . site_url("disponibilidade/delete/" . $disponibilidade->id) . "'>Eliminar</a></td>";
                      echo '</tr>';
                    }
                  ?>
                    <tr style="display: none;" id="form_add">
                      <form action="disponibilidades/add" method="POST">
                        <td><input class="form-control" name="data_inicio"/></td>
                        <td><input class="form-control" name="data_fim"/></td>
                        <td><input class="form-control" name="periodicidade"/></td>
                        <td><input class="form-control" name="repetir_ate"/></td>
                        <td colspan="2"><input class='btn btn-primary btn-sm' type="submit" value="Adicionar"/></td>
                      </form>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <h2>Oportunidades correspondentes</h2>
  <div class="row">
    <div class="col-md-6">

      <div class="panel panel-default">
        <div class="panel-body">
        </div>
      </div>

    </div>

    <div class="col-md-6">

      <div class="panel panel-default">
        <div class="panel-body">
        </div>
      </div>

    </div>
  </div> -->
</div>
