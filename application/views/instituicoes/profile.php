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
      <?php foreach ($this->oportunidades_voluntariado_ativas->result() as $oportunidade_ativa) { ?>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-6">
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
                  <a class="btn btn-warning btn-sm" href="<?= site_url('oportunidades_voluntariado/edit/' . $oportunidade_ativa->id) ?>">  Editar Oportunidade</a>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <p><strong>Voluntários Compatíveis:</strong></p>
                    <p>Nenhum</p>
                  </div>
                  <div class="row">
                    <p><strong>Voluntários Disponíveis:</strong></p>
                    <p>Nenhum</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } ?>

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
</div>
