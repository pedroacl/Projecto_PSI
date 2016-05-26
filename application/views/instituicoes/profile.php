<div class="container-fluid content">
  <div class="row">
    <div class="col-md-12">

      <div class="panel panel-default">
        <div class="panel-body profile-instituicao">
          <div class="row">
            <div class="col-md-5">
              <h1><?= $this->instituicao->nome == '' ? "Instituição" : $this->instituicao->nome ?></h1>
              <dl class="dl-horizontal">
                <?php if ($this->instituicao->morada) { ?>
                  <dt>Morada</dt>
                  <dd><?= $this->instituicao->morada ?></dd>
                <?php } ?>

                <?php if ($this->instituicao->email_instituicao) { ?>
                  <dt>Email de Instituição</dt>
                  <dd><?= $this->instituicao->email_instituicao ?></dd>
                <?php } ?>

                <?php if ($this->instituicao->website) { ?>
                  <dt>Website</dt>
                  <dd><?= $this->instituicao->website ?></dd>
                <?php } ?>

                <?php if ($this->instituicao->telefone) { ?>
                  <dt>Telefone</dt>
                  <dd><?= $this->instituicao->telefone ?></dd>
                <?php } ?>

                <?php if ($this->instituicao->email) { ?>
                  <dt>Email</dt>
                  <dd><?= $this->instituicao->email ?></dd>
                <?php } ?>

                <?php if ($this->area_geografica_data->num_rows() > 0) {
                  $distrito = $this->area_geografica_data->row()->distrito;
                  $concelho = $this->area_geografica_data->row()->concelho;
                  $freguesia = $this->area_geografica_data->row()->freguesia;  ?>

                  <?php if ($distrito !== '') { ?>
                    <dt>Distrito</dt>
                    <dd><?= $distrito ?></dd>
                  <?php } ?>

                  <?php if ($concelho !== '') { ?>
                    <dt>Concelho</dt>
                    <dd><?= $concelho ?></dd>
                  <?php } ?>

                  <?php if ($freguesia !== '') { ?>
                    <dt>Freguesia</dt>
                    <dd><?= $freguesia ?></dd>
                  <?php } ?>
                <?php } ?>
              </dl>
            </div>

            <div class="col-md-7">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <?php if ($this->instituicao->id_utilizador === $this->id_utilizador) { ?>
                      <div class="pull-right buttons-top">
                        <!-- <a class="btn btn-warning" href="change_password">Alterar Password</a> -->
                        <a class="btn btn-warning" href="<?= site_url('instituicoes/edit_profile') ?>">Editar Perfil</a>
                        <a class="btn btn-warning" href="<?= site_url('oportunidades_voluntariado/add') ?>">Adicionar Oportunidade de Voluntariado</a>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="row">
                    <p><?= $this->instituicao->descricao ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if($this->oportunidades_voluntariado_ativas->num_rows() > 0) { ?>
    <h2>Oportunidades activas</h2>
    <div class="row">
      <?php foreach ($this->oportunidades_voluntariado_ativas->result() as $oportunidade_ativa) {
          $size = $this->instituicao->id_utilizador === $this->id_utilizador ? 12 : 6;
          $size_inside = $this->instituicao->id_utilizador === $this->id_utilizador ? 6 : 12;
        ?>
        <div class="col-md-<?= $size ?>">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-<?= $size_inside ?>">
                  <h3><?= $oportunidade_ativa->nome ?></h3>
                  <strong>Função:</strong>
                  <p><?= $oportunidade_ativa->funcao ?></p>
                  <strong>País:</strong>
                  <p><?= $oportunidade_ativa->pais ?></p>
                  <strong>Número de Vagas:</strong>
                  <p><?= $oportunidade_ativa->vagas ?></p>
                  <strong>Distrito:</strong>
                  <p><?= $oportunidade_ativa->distrito ?></p>
                  <strong>Concelho</strong>
                  <p><?= $oportunidade_ativa->concelho ?></p>
                  <strong>Freguesia</strong>
                  <p><?= $oportunidade_ativa->freguesia ?></p>
                  <a class="btn btn-warning btn-sm" href="<?= site_url('oportunidades_voluntariado/show/' . $oportunidade_ativa->id) ?>">  Ver Detalhes</a>
                  <?php if ($this->instituicao->id_utilizador === $this->id_utilizador) { ?>
                    <a class="btn btn-warning btn-sm" href="<?= site_url('oportunidades_voluntariado/edit/' . $oportunidade_ativa->id) ?>">  Editar Oportunidade</a>
                  <?php } ?>
                </div>
                <?php if ($this->instituicao->id_utilizador === $this->id_utilizador) { ?>
                  <div class="col-md-6">
                    <div class="row">
                      <p><strong>Voluntários Compatíveis:</strong></p>
                      <?php if ($oportunidade_ativa->matching_nao_inscritos->num_rows() > 0) { ?>

                        <div id="carousel-example-generic-<?= $oportunidade_ativa->id ?>-nao_inscrito" class="carousel slide no-shadow" data-ride="carousel">
                          <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic-<?= $oportunidade_ativa->id ?>-nao_inscrito" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic-<?= $oportunidade_ativa->id ?>-nao_inscrito" data-slide-to="1"></li>
                          </ol>

                          <div class="carousel-inner" role="listbox">
                            <?php foreach ($oportunidade_ativa->matching_nao_inscritos->result() as $vol_compativel) { ?>
                              <div class="item active">
                                <div class="mini-perfil">
                                  <h2><?php echo $vol_compativel->nome ?></h2>
                                  <div class="profile-photo-container-oportunidade">
                                    <a href="#" class="thumbnail">
                                      <img src="<?= base_url($vol_compativel->foto) ?>">
                                    </a>
                                  </div>
                                </div>
                                <div class="carousel-caption">
                                  <a href="<?= site_url('voluntarios/profile/' . $vol_compativel->id_utilizador); ?>" class="btn btn-warning">Ver perfil</a>
                                </div>
                              </div>
                            <?php } ?>
                            <div class="item">
                              <img src="<?= base_url('/assets/images/fcul2.jpg') ?>" alt="Campus FCUL">
                              <div class="carousel-caption">
                              </div>
                            </div>
                          </div>

                          <a class="left carousel-control" href="#carousel-example-generic-<?= $oportunidade_ativa->id ?>-nao_inscrito" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="right carousel-control" href="#carousel-example-generic-<?= $oportunidade_ativa->id ?>-nao_inscrito" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                      <?php } else {
                        echo "<p>Não existem voluntários compatíveis!</p>";
                      } ?>

                    </div>
                    <div class="row">
                      <p><strong>Voluntários Disponíveis:</strong></p>
                      <?php if ($oportunidade_ativa->matching_inscritos->num_rows() > 0) { ?>

                      <div id="carousel-example-generic-<?= $oportunidade_ativa->id ?>-inscrito" class="carousel slide no-shadow" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carousel-example-generic-<?= $oportunidade_ativa->id ?>-inscrito" data-slide-to="0" class="active"></li>
                          <li data-target="#carousel-example-generic-<?= $oportunidade_ativa->id ?>-inscrito" data-slide-to="1"></li>
                        </ol>

                        <div class="carousel-inner" role="listbox">
                          <?php foreach ($oportunidade_ativa->matching_inscritos->result() as $vol_inscrito) { ?>
                            <div class="item active">
                              <div class="mini-perfil">
                                <h2><?php echo $vol_inscrito->nome ?></h2>
                                <div class="profile-photo-container-oportunidade">
                                  <a href="#" class="thumbnail">
                                    <img src="<?= base_url($vol_inscrito->foto) ?>">
                                  </a>
                                </div>
                              </div>
                              <div class="carousel-caption">
                                <a href="<?= site_url('oportunidades_voluntariado/aceitar/' . $oportunidade_ativa->id . "/" . $vol_inscrito->id_utilizador); ?>" class="btn btn-success">Aceitar</a>
                                <a href="<?= site_url('voluntarios/profile/' . $vol_inscrito->id_utilizador); ?>" class="btn btn-warning">Ver perfil</a>
                              </div>
                            </div>
                          <?php } ?>
                          <div class="item">
                            <img src="<?= base_url('/assets/images/fcul2.jpg') ?>" alt="Campus FCUL">
                            <div class="carousel-caption">
                            </div>
                          </div>
                        </div>

                        <a class="left carousel-control" href="#carousel-example-generic-<?= $oportunidade_ativa->id ?>-inscrito" role="button" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic-<?= $oportunidade_ativa->id ?>-inscrito" role="button" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                      <?php } else {
                        echo "<p>Não existem voluntários inscritos.</p>";
                      } ?>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } ?>

  <?php if ($this->instituicao->id_utilizador === $this->id_utilizador) { ?>
    <?php if($this->oportunidades_voluntariado_inativas->num_rows() > 0) { ?>
      <h2>Oportunidades inactivas</h2>
      <div class="row">
        <?php foreach ($this->oportunidades_voluntariado_inativas->result() as $oportunidade_inactiva) { ?>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-body">
                <h3><?= $oportunidade_inactiva->nome ?></h3>
                <strong>Função:</strong>
                <p><?= $oportunidade_inactiva->funcao ?></p>
                <strong>País:</strong>
                <p><?= $oportunidade_inactiva->pais ?></p>
                <strong>Número de Vagas:</strong>
                <p><?= $oportunidade_inactiva->vagas ?></p>
                <strong>Distrito:</strong>
                <p><?= $oportunidade_ativa->distrito ?></p>
                <strong>Concelho</strong>
                <p><?= $oportunidade_ativa->concelho ?></p>
                <strong>Freguesia</strong>
                <p><?= $oportunidade_ativa->freguesia ?></p>
                <a class="btn btn-warning btn-sm" href="<?= site_url('oportunidades_voluntariado/show/' . $oportunidade_inactiva->id) ?>">  Ver Detalhes</a>
                <a class="btn btn-warning btn-sm" href="<?= site_url('oportunidades_voluntariado/edit/' . $oportunidade_inactiva->id) ?>">Editar Oportunidade</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  <?php } ?>
</div>
