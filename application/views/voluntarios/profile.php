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
                  <img src="/assets/images/fcul1.jpg" alt="Name user">
                </a>
              </div>
              <dl class="dl-horizontal">
                <dt>Telefone</dt>
                <dd>2193123123</dd>

                <dt>Género</dt>
                <dd><?php echo ($this->voluntario->genero == 'm' ? 'Masculino' : 'Feminino'); ?></dd>

                <dt>Data de Nascimento</dt>
                <dd><?php echo $this->voluntario->data_nascimento ?></dd>

                <dt>Email</dt>
                <dd><?php echo $this->voluntario->email ?></dd>

                <dt>Distrito</dt>
                <dd><?php echo $this->voluntario->distrito ?></dd>

                <dt>Concelho</dt>
                <dd><?php echo $this->voluntario->concelho ?></dd>

                <dt>Freguesia</dt>
                <dd><?php echo $this->voluntario->freguesia ?></dd>
              </dl>
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                  <h1><?php echo $this->voluntario->nome ?></h1>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <h4>Grupos de atuação</h4>
                  <ul>
                    <li>Grupo 1</li>
                    <li>Grupo 2</li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <h4>Areas de Interesse</h4>
                  <ul>
                    <li>Area 1</li>
                    <li>Area 2</li>
                  </ul>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <h4>Habilitações Académicas</h4>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Tipo</th>
                        <th>Curso</th>
                        <th>Instituição</th>
                        <th>Data de Concluisão</th>
                      </tr>
                      <tr>
                        <td>Tipo</td>
                        <td>Curso</td>
                        <td>Instituição</td>
                        <td>Data de Concluisão</td>
                      </tr>
                    </tbody>
                  </table>
                  
                  <h4>Disponibilidade</h4>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Data de Inicio</th>
                        <th>Data de Fim</th>
                        <th>Periodicidade</th>
                        <th>Repetir até</th>
                      </tr>
                      <tr>
                        <td>Data de Inicio</td>
                        <td>Data de Fim</td>
                        <td>Periodicidade</td>
                        <td>Repetir até</td>
                      </tr>
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
