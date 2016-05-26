<div class="container-fluid content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body profile-voluntario">
          <div class="row">
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                  <h1><?= $this->oportunidade_voluntariado->nome_oportunidade ?></h1>
                  <?php if ($this->utilizador_owner === $this->id_utilizador) { ?>
                    <a class="btn btn-warning pull-right" href="<?= site_url('oportunidades_voluntariado/edit/' . $this->oportunidade_voluntariado->id) ?>">Editar Oportunidade</a>
                  <?php } ?>
                  <dl class="dl-horizontal">
                    <dt>Função</dt>
                    <dd><?= $this->oportunidade_voluntariado->funcao ?></dd>

                    <dt>País</dt>
                    <dd><?= $this->oportunidade_voluntariado->pais ?></dd>

                    <dt>Vagas</dt>
                    <dd><?= $this->oportunidade_voluntariado->vagas?></dd>

                    <dt>Ativa</dt>
                    <dd><?= $this->oportunidade_voluntariado->ativa == 'y' ? 'Sim' : 'Não' ?></dd>

                    <dt>Grupo de Atuação</dt>
                    <dd><?= $this->oportunidade_voluntariado->nome_grupo_atuacao ?></dd>

                    <dt>Área de Interesse</dt>
                    <dd><?= $this->oportunidade_voluntariado->nome_area_interesse ?></dd>

                    <dt>Distrito</dt>
                    <dd><?= $this->oportunidade_voluntariado->distrito ?></dd>

                    <dt>Concelho</dt>
                    <dd><?= $this->oportunidade_voluntariado->concelho ?></dd>

                    <dt>Freguesia</dt>
                    <dd><?= $this->oportunidade_voluntariado->freguesia ?></dd>

                  </dl>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12" id="edit_disponibilidades">
              <?php
                $title = (isset($this->disponibilidades)) && ($this->disponibilidades->num_rows() > 0) ? 'Disponibilidades' : 'Não existem disponibilidades adicionadas';
                $button_text = (isset($this->disponibilidades)) && ($this->disponibilidades->num_rows() > 0) ? 'Editar' : 'Adicionar';
              ?>

              <h4><?= $title ?>
                <?php if ($this->utilizador_owner === $this->id_utilizador) { ?>
                  <a class="btn btn-warning btn-sm"><?= $button_text ?></a>
                <?php } ?>
              </h4>

              <?php if (isset($this->disponibilidades)) { ?>
                <table class="table">
                  <tbody>
                    <tr>
                      <th>Data de Inicio</th>
                      <th>Data de Fim</th>
                      <th class="actions" style="display: none;">Acções</th>
                    </tr>

                    <?php foreach ($this->disponibilidades->result() as $disponibilidade) {
                      echo '<tr>';
                      echo '<td>' . $disponibilidade->data_inicio . '</td>';
                      echo '<td>' . $disponibilidade->data_fim . '</td>';
                      echo "<td class='actions' style='display: none;'><a class='btn btn-warning btn-sm' href='" . site_url("disponibilidades/edit/" . $disponibilidade->id) . "'>Editar</a><a class='btn btn-danger btn-sm' href='" . site_url("disponibilidades/delete/" . $disponibilidade->id) . "'>Eliminar</a></td>";
                      echo '</tr>';
                    } ?>

                    <tr style="display: none;" id="form_add">
                      <form action="<?php echo site_url('/oportunidades_voluntariado/add_disponibilidade/' . $this->oportunidade_voluntariado->id)?>" method="POST">
                        <td>
                          <div class='input-group date datepicker' data-provide="datepicker" data-date-format="yyyy/mm/dd">
                            <input name="data_inicio" value="" type='text' class="form-control" />
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </td>
                        <td>
                          <div class='input-group date datepicker' data-provide="datepicker" data-date-format="yyyy/mm/dd">
                            <input name="data_fim" value="" type='text' class="form-control" />
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </td>
                        <td><input class='btn btn-primary btn-md' type="submit" value="Adicionar"/></td>
                      </form>
                    </tr>
                  </tbody>
                </table>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Voluntarios inscritos -->
  <?php if ($this->utilizador_owner === $this->id_utilizador) { ?>
    <?php if ($this->voluntarios_inscritos->num_rows()) { ?>
      <h2>Voluntários Inscritos</h2>
      <div class="row">
        <div class="col-md-6">
          <?php foreach ($this->voluntarios_matching->result() as $vol) { ?>
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <h3><?= $vol->nome ?></h3>
                  </div>
                </div>
                  <div class="row">
                    <div class="col-md-6">
                      <a href="#" class="thumbnail">
                        <img src="<?= base_url($vol->foto) ?>">
                      </a>
                    </div>
                    <div class="col-md-6">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias maxime voluptates placeat facilis laboriosam quia tempore, saepe aut accusantium quis iure perspiciatis, error dolor eligendi a, nostrum delectus, qui ipsum.
                    </div>
                  </div>
                  <div class="row">
                    <a href="<?= site_url('oportunidades_voluntariado/aceitar/' . $this->oportunidade_voluntariado->id . "/" . $vol->id_voluntario) ?>" class="btn btn-success">Aceitar</a>
                    <a href="<?= site_url('voluntarios/profile/' . $vol->id_voluntario) ?>" class="btn btn-warning">Ver perfil</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      <?php } else {  ?>
        <h2>Não existem voluntários inscritos</h2>
      <?php } ?>


    <!-- Voluntarios aceites -->

      <?php if ($this->voluntarios_aceites->num_rows()) { ?>
      <h2>Voluntários aceites</h2>
      <div class="row">
        <div class="col-md-6">
          <?php foreach ($this->voluntarios_aceites->result() as $vol) { ?>
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <h3><?= $vol->nome ?></h3>
                  </div>
                </div>
                  <div class="row">
                    <div class="col-md-6">
                      <a href="#" class="thumbnail">
                        <img src="<?= base_url($vol->foto) ?>">
                      </a>
                    </div>
                    <div class="col-md-6">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias maxime voluptates placeat facilis laboriosam quia tempore, saepe aut accusantium quis iure perspiciatis, error dolor eligendi a, nostrum delectus, qui ipsum.
                    </div>
                  </div>
                  <div class="row">
                    <a href="<?= site_url('voluntarios/profile/' . $vol->id_voluntario) ?>" class="btn btn-warning">Ver perfil</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      <?php } else {  ?>
        <h2>Não existem voluntários aceites</h2>
      <?php } ?>
    <?php } ?>
    
</div>
