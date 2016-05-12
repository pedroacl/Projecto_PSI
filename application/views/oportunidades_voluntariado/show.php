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
                  <a class="btn btn-warning pull-right" href="<?= site_url('oportunidades_voluntariado/edit/' . $this->oportunidade_voluntariado->id) ?>">Editar Oportunidade</a>
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
                <h4><?= $title ?> <a class="btn btn-warning btn-sm"><?= $button_text ?></a></h4>
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

                      if((isset($this->disponibilidades)) && ($this->disponibilidades->num_rows() > 0)) {
                        foreach ($this->disponibilidades->result() as $disponibilidade) {
                          echo '<tr>';
                          echo '<td>' . date("d/m/Y", strtotime($disponibilidade->data_inicio)) . '</td>';
                          echo '<td>' . date("d/m/Y", strtotime($disponibilidade->data_fim)) . '</td>';
                          echo '<td>' . $disponibilidade->tipo_periodicidade . '</td>';
                          echo '<td>' . date("d/m/Y", strtotime($disponibilidade->data_fim_periodicidade)) . '</td>';
                          echo "<td class='actions' style='display: none;'><a class='btn btn-warning btn-sm' href='" . site_url("disponibilidades/edit/" . $disponibilidade->id) . "'>Editar</a><a class='btn btn-danger btn-sm' href='" . site_url("disponibilidades/delete/" . $disponibilidade->id) . "'>Eliminar</a></td>";
                          echo '</tr>';
                        }
                      }
                    ?>
                      <tr style="display: none;" id="form_add">
                        <form action="/oportunidades_voluntariado/add_disponibilidade/<?= $this->oportunidade_voluntariado->id ?>" method="POST">
                          <td>
                            <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                              <input name="data_inicio" value="" type='text' class="form-control" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </td>
                          <td>
                            <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                              <input name="data_fim" value="" type='text' class="form-control" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </td>
                          <td>
                            
                          </td>
                          <td>
                            <div class='input-group date datepicker' data-provide="datepicker" data-date-format="dd/mm/yyyy">
                              <input name="repetir_ate" value="" type='text' class="form-control" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </td>
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

  <h2>Candidaturas de Voluntários</h2>
  <div class="row">
    <div class="col-md-6">

      <div class="panel panel-default">
        <div class="panel-body">
          Nenhuma
        </div>
      </div>

    </div>
  </div>

</div>
