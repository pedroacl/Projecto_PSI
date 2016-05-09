<?php echo form_open('email/send'); ?>

<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">

          <form action="" method="POST" enctype="multipart/form-data" id="form">
            <h2>Adicionar Oportunidade de Voluntariado</h2>

            <!-- Campos de um Voluntario -->

            <div class="voluntario_fields">
              <?php echo validation_errors() ?>

              <div class="form-group <?= has_error('nome_utilizador') ?>" >
                <label class="control-label">Nome</label>
                <?= form_error('nome', "<span class='help-block'>", "</span>")?>
                <input name="nome" value="<?= set_value('nome'); ?>" class="form-control" placeholder="Nome"></input>
              </div>

             <div class="form-group <?= has_error('pais') ?>" >
                <label class="control-label">País</label>
                <?= form_error('pais', "<span class='help-block'>", "</span>")?>
                <input name="pais" value="<?= set_value('pais'); ?>" class="form-control" placeholder="País	"></input>
              </div>

             <div class="form-group <?= has_error('vagas') ?>" >
                <label class="control-label">Vagas</label>
                <?= form_error('vagas', "<span class='help-block'>", "</span>")?>
                <input name="pais" value="<?= set_value('vagas'); ?>" class="form-control" placeholder="Vagas"></input>
              </div>

              	<div class="form-group <?= has_error('funcao') ?>" >
                	<label class="control-label">Função</label>
                	<?= form_error('funcao', "<span class='help-block'>", "</span>")?>
                	<input name="pais" value="<?= set_value('funcao'); ?>" class="form-control" placeholder="Função"></input>
              	</div>

               <div class="form-group <?= has_error('funcao') ?>" >
                	<label class="control-label">Ativa</label>
                	<?= form_error('funcao', "<span class='help-block'>", "</span>")?>
                	<checkbox name="pais" value="<?= set_value('funcao'); ?>" class="form-control" placeholder="Função"/>
              </div>

           


              <br>
              <h3>Área Geográfica</h3>

              <div class="form-group <?= has_error('distrito') ?>">
                <label class="control-label">Distrito</label>
                <?= form_error('distrito', "<span class='help-block'>", "</span>")?>
                <select id="distrito" class="form-control" name="distrito">
                  <option value="default">-</option>
                  <? if ($this->voluntario_data->distrito !== '') { ?>
                    <option value="<?= $this->voluntario_data->distrito ?>" <?= set_select('distrito', $this->voluntario_data->distrito, TRUE) ?>><?= $this->voluntario_data->distrito ?></option>
                  <? } ?>
                </select>
              </div>

              <div class="form-group <?= has_error('concelho') ?>">
                <label class="control-label">Concelho</label>
                <?= form_error('concelho', "<span class='help-block'>", "</span>")?>
                <select id="concelho" class="form-control" name="concelho">
                  <option value="default">-</option>
                  <? if ($this->voluntario_data->concelho !== '') { ?>
                  <option value="<?= $this->voluntario_data->concelho ?>" <?= set_select('concelho', $this->voluntario_data->concelho, TRUE) ?>><?= $this->voluntario_data->concelho ?></option>
                  <? } ?>
                </select>
              </div>

              <div class="form-group <?= has_error('freguesia') ?>">
                <label class="control-label">Freguesia</label>
                <?= form_error('freguesia', "<span class='help-block'>", "</span>")?>
                <select id="freguesia" class="form-control" name="freguesia">
                  <option value="default">-</option>
                  <? if ($this->voluntario_data->freguesia !== '') { ?>
                  <option value="<?= $this->voluntario_data->freguesia ?>" <?= set_select('freguesia', $this->voluntario_data->freguesia, TRUE) ?>><?= $this->voluntario_data->freguesia ?></option>
                  <? } ?>
                </select>
              </div>

              <br>

            <div class="pull-right">
              <a href="#" onclick="window.history.back();" class="btn btn-danger">Cancelar</a>
              <button class="btn btn-success" type="submit">Atualizar</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>
