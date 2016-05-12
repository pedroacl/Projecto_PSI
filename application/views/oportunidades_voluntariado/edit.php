<div class="container-fluid content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-body">

          <form action="" method="POST" enctype="multipart/form-data" id="form">
            <h2>Editar Oportunidade de Voluntariado</h2>

            <div class="form-group <?= has_error('nome') ?>" >
              <label class="control-label">Nome</label>
              <?= form_error('nome', "<span class='help-block'>", "</span>")?>
              <input name="nome" value="<?= set_value('nome', $this->oportunidade_voluntariado_data->nome_oportunidade); ?>" class="form-control" placeholder="Nome"></input>
            </div>

            <div class="form-group <?= has_error('pais') ?>" >
              <label class="control-label">País</label>
              <?= form_error('pais', "<span class='help-block'>", "</span>")?>
              <input name="pais" value="<?= set_value('pais', $this->oportunidade_voluntariado_data->pais); ?>" class="form-control" placeholder="País"></input>
            </div>

            <div class="form-group <?= has_error('vagas') ?>" >
              <label class="control-label">Vagas</label>
              <?= form_error('vagas', "<span class='help-block'>", "</span>")?>
              <input type="number" name="vagas" value="<?= set_value('vagas', $this->oportunidade_voluntariado_data->vagas); ?>" class="form-control" placeholder="Vagas"></input>
            </div>

          	<div class="form-group <?= has_error('funcao') ?>" >
            	<label class="control-label">Função</label>
            	<?= form_error('funcao', "<span class='help-block'>", "</span>")?>
            	<input name="funcao" value="<?= set_value('funcao', $this->oportunidade_voluntariado_data->funcao); ?>" class="form-control" placeholder="Função"></input>
          	</div>

            <div class="checkbox">
              <label class="control-label">
                <input type="checkbox" name="ativa" value="y" <?php echo $this->oportunidade_voluntariado_data->ativa == 'y' ? 'checked' : '' ?>> Ativa
              </label>
            </div>

            <div class="form-group <?= has_error('id_grupo_atuacao') ?>">
              <label class="control-label">Grupo de Atuação</label>
              <?= form_error('id_grupo_atuacao', "<span class='help-block'>", "</span>")?>
              <?php echo form_dropdown('id_grupo_atuacao', $this->grupos_atuacao_data, set_value('id_grupo_atuacao', $this->oportunidade_voluntariado_data->id_grupo_atuacao), "class='form-control'") ?>
            </div>

            <div class="form-group <?= has_error('id_area_interesse') ?>">
              <label class="control-label">Área de Interesse</label>
              <?= form_error('id_area_interesse', "<span class='help-block'>", "</span>")?>
              <?php echo form_dropdown('id_area_interesse', $this->areas_interesse_data, set_value('id_area_interesse', $this->oportunidade_voluntariado_data->id_area_interesse), "class='form-control'") ?>
            </div>

            <br>
            <h3>Área Geográfica</h3>

            <div class="form-group <?= has_error('distrito') ?>">
              <label class="control-label">Distrito</label>
              <?= form_error('distrito', "<span class='help-block'>", "</span>")?>
              <select id="distrito" class="form-control" name="distrito">
                <option value="default">-</option>
              </select>
            </div>

            <div class="form-group <?= has_error('concelho') ?>">
              <label class="control-label">Concelho</label>
              <?= form_error('concelho', "<span class='help-block'>", "</span>")?>
              <select id="concelho" class="form-control" name="concelho">
                <option value="default">-</option>
              </select>
            </div>

            <div class="form-group <?= has_error('freguesia') ?>">
              <label class="control-label">Freguesia</label>
              <?= form_error('freguesia', "<span class='help-block'>", "</span>")?>
              <select id="freguesia" class="form-control" name="freguesia">
                <option value="default">-</option>
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
