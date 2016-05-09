<div class="container-fluid content">
  <div class="row">
    <div class="col-md-12">

      <div class="panel panel-default">
        <div class="panel-body profile-voluntario">
          <div class="row buttons-top">
            <div class="col-md-12">
              <div class="pull-right">
                <!-- <a class="btn btn-warning" href="change_password">Alterar Password</a> -->
                <a class="btn btn-warning" href="<?= site_url('instituicoes/edit_profile') ?>">Editar Perfil</a>
                <a class="btn btn-warning" href="<?= site_url('oportunidades_voluntariado/add') ?>">Adicionar Oportunidade de Voluntariado</a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
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

              <a class="btn btn-warning" href="<?= site_url('instituicoes/edit_profile') ?>">Editar Perfil</a>
            </div>

            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                  <h1><?= $this->instituicao->nome ?></h1>
                  <?= $this->instituicao->descricao ?>
                  (Descrição goes here)
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
  </div>

  <h2>Oportunidades inactivas</h2>
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
  </div>
</div>
