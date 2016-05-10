<div class="container-fluid content">
  <div class="row">
    <div class="col-md-12">

      <div class="panel panel-default">
        <div class="panel-body profile-instituicao">
          <div class="row">
            <div class="col-md-5">
              <h1><?= $this->instituicao->nome ?></h1>
              <dl class="dl-horizontal">
                <dt>Morada</dt>
                <dd><?= $this->instituicao->morada ?></dd>

                <dt>Email de Instituição</dt>
                <dd><?= $this->instituicao->email_instituicao ?></dd>

                <dt>Website</dt>
                <dd><?= $this->instituicao->website ?></dd>

                <dt>Telefone</dt>
                <dd><?= $this->instituicao->telefone ?></dd>

                <dt>Email</dt>
                <dd><?= $this->instituicao->email ?></dd>

                <?php if ($this->area_geografica_data->num_rows() > 0) { ?>
                  <dt>Distrito</dt>
                  <dd><?= $this->area_geografica_data->distrito ?></dd>

                  <dt>Concelho</dt>
                  <dd><?= $this->area_geografica_data->concelho ?></dd>

                  <dt>Freguesia</dt>
                  <dd><?= $this->area_geografica_data->freguesia ?></dd>
                <?php } ?>
              </dl>
            </div>

            <div class="col-md-7">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="pull-right buttons-top">
                      <!-- <a class="btn btn-warning" href="change_password">Alterar Password</a> -->
                      <a class="btn btn-warning" href="<?= site_url('instituicoes/edit_profile') ?>">Editar Perfil</a>
                      <a class="btn btn-warning" href="<?= site_url('oportunidades_voluntariado/add') ?>">Adicionar Oportunidade de Voluntariado</a>
                    </div>
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

  <h2>Oportunidades activas</h2>
  <div class="row">
    <?php if($this->oportunidades_voluntariado_ativas->num_rows() > 0) { ?>
      <?php foreach ($this->oportunidades_voluntariado_ativas->result() as $oportunidade_ativa) { ?>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-6">
                  <h3><?php echo $oportunidade_ativa->nome ?></h3>
                  <strong>Função:</strong>
                  <p><?php echo $oportunidade_ativa->funcao ?></p>
                  <strong>Pais:</strong>
                  <p><?php echo $oportunidade_ativa->pais ?></p>
                  <strong>Número de Vagas:</strong>
                  <p><?php echo $oportunidade_ativa->vagas ?></p>
                  <a class="btn btn-warning btn-sm" href="<?php echo site_url('oportunidades_voluntariado/edit/' . $oportunidade_ativa->id) ?>">Editar Oportunidade</a>
                  
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
    <?php } ?>
  </div>

  <h2>Oportunidades inactivas</h2>
  <div class="row">
    <?php if($this->oportunidades_voluntariado_inativas->num_rows() > 0) { ?>
      <?php foreach ($this->oportunidades_voluntariado_inativas->result() as $oportunidade_inactiva) { ?>
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <h3><?php echo $oportunidade_inactiva->nome ?></h3>
              <strong>Função:</strong>
              <p><?php echo $oportunidade_inactiva->funcao ?></p>
              <strong>Pais:</strong>
              <p><?php echo $oportunidade_inactiva->pais ?></p>
              <strong>Número de Vagas:</strong>
              <p><?php echo $oportunidade_inactiva->vagas ?></p>
              <a class="btn btn-warning btn-sm" href="<?php echo site_url('oportunidades_voluntariado/edit/' . $oportunidade_inactiva->id) ?>">Editar Oportunidade</a>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
</div>
