<div class="container-fluid content">
  <div class="row">
    <div class="col-md-12">

      <div class="panel panel-default">
        <div class="panel-body profile-voluntario">
          <div class="row buttons-top">
            <div class="col-md-12">
              <div class="pull-right">
                <!-- <a class="btn btn-warning" href="change_password">Alterar Password</a> -->
                <a class="btn btn-warning" href="edit_profile">Editar Perfil</a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <dl class="dl-horizontal">
                <dt>Descrição</dt>
                <dd><?= $this->instituicao->descricao ?></dd>

                <dt>Morada</dt>
                <dd><?= $this->instituicao->morada ?></dd>

                <dt>Email de Instituição</dt>
                <dd><?= $this->instituicao->email_instituicao ?></dd>

                <dt>Website</dt>
                <dd><?= $this->instituicao->website ?></dd>

                <dt>Email</dt>
                <dd><?= $this->instituicao->email ?></dd>

                <?php if($this->area_geografica->row() != null) { ?>
                  <dt>Distrito</dt>
                  <dd><?= $this->area_geografica->distrito ?></dd>

                  <dt>Concelho</dt>
                  <dd><?= $this->area_geografica->concelho ?></dd>

                  <dt>Freguesia</dt>
                  <dd><?= $this->area_geografica->freguesia ?></dd>
                <?php } ?>
              </dl>

              <a class="btn btn-warning" href="<?= site_url('instituicoes/edit_profile') ?>">Editar Perfil</a>
            </div>

            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                  <h1><?= $this->instituicao->nome ?></h1>
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

                <!-- Areas de Interesse -->

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
                <div class="col-md-12">
                  <h4>Disponibilidades</h4>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Data de Inicio</th>
                        <th>Data de Fim</th>
                        <th>Periodicidade</th>
                        <th>Repetir até</th>
                        <th></th>
                        <th></th>
                      </tr>
                      <?php
                        foreach ($this->disponibilidades->result() as $disponibilidade) {
                          echo '<tr>';
                          echo '<td>' . date("d/m/Y", strtotime($disponibilidade->data_inicio)) . '</td>';
                          echo '<td>' . date("d/m/Y", strtotime($disponibilidade->data_fim)) . '</td>';
                          echo '<td>' . $disponibilidade->tipo_periodicidade . '</td>';
                          echo '<td>' . date("d/m/Y", strtotime($disponibilidade->data_fim_periodicidade)) . '</td>';
                          echo '</tr>';
                        }
                      ?>
                      <form action="disponibilidades/add" method="POST">
                        <tr>
                          <td><input name="nome"/></td>
                          <td><input name="curso"/></td>
                          <td><input name="instituto_ensino"/></td>
                          <td><input name="data_conclusao"/></td>
                          <td colspan="2"><input type="submit" value="Adicionar"/></td>
                        </tr>
                      </form>
                    </tbody>
                  </table>
                </div>
              </div>
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
