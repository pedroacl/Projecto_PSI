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
              <div class="profile-photo-container">
                <a href="#" class="thumbnail">
                  <img src="<?= $this->voluntario->foto ?>">
                </a>
              </div>
              <dl class="dl-horizontal">
                <dt>Telefone</dt>
                <dd><?= $this->voluntario->telefone ?></dd>

                <dt>Género</dt>
                <dd><?= ($this->voluntario->genero == 'm' ? 'Masculino' : 'Feminino'); ?></dd>

                <dt>Data de Nascimento</dt>
                <dd><?= $this->voluntario->data_nascimento ?></dd>

                <dt>Email</dt>
                <dd><?= $this->voluntario->email ?></dd>

                <dt>Distrito</dt>
                <dd><?= $this->voluntario->distrito ?></dd>

                <dt>Concelho</dt>
                <dd><?= $this->voluntario->concelho ?></dd>

                <dt>Freguesia</dt>
                <dd><?= $this->voluntario->freguesia ?></dd>
              </dl>
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                  <h1><?= $this->voluntario->nome ?></h1>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <h4>Grupos de atuação</h4>
                  <ul>
                    <?php foreach ($this->grupos_atuacao as $grupo_atuacao) {
                      echo '<li>' . $grupo_atuacao->nome . '</li>';
                    } ?>
                  </ul>
                </div>
                <div class="col-md-6">
                  <h4>Areas de Interesse</h4>
                  <ul>
                    <?php foreach ($this->areas_interesse as $areas_interesse) {
                      echo '<li>' . $areas_interesse->nome . '</li>';
                    } ?>
                  </ul>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <h4>Habilitações Académicas</h4>
                  <table class="table">
                    <tbody>
                      <?php
                        foreach ($this->habilitacoes_academicas as $habilitacao_academica) {
                          echo '<tr>';
                          echo '<td>' . $habilitacao_academica->nome . '</td>';
                          echo '<td>' . $habilitacao_academica->curso . '</td>';
                          echo '<td>' . $habilitacao_academica->instituto_ensino . '</td>';
                          echo '<td>' . date("d/m/Y", strtotime($habilitacao_academica->data_conclusao)) . '</td>';
                          echo '</tr>';
                        }
                      ?>
                    </tbody>
                  </table>

                  <h4>Disponibilidades</h4>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Data de Inicio</th>
                        <th>Data de Fim</th>
                        <th>Periodicidade</th>
                        <th>Repetir até</th>
                      </tr>
                      <?php
                        foreach ($this->disponibilidades as $disponibilidade) {
                          echo '<tr>';
                          echo '<td>' . date("d/m/Y", strtotime($disponibilidade->data_inicio)) . '</td>';
                          echo '<td>' . date("d/m/Y", strtotime($disponibilidade->data_fim)) . '</td>';
                          echo '<td>' . $disponibilidade->tipo_periodicidade . '</td>';
                          echo '<td>' . date("d/m/Y", strtotime($disponibilidade->data_fim_periodicidade)) . '</td>';
                          echo '</tr>';
                        }
                      ?>
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
