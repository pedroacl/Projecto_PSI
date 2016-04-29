
            <div class="instituicao_fields" style="display: none;">
              <div class="form-group">
                <label class="control-label">Nome</label>
                <input class="form-control" name="name" placeholder="Nome Completo" required></input>
              </div>

              <div class="form-group">
                <label class="control-label">Género</label>
                <div class="checkbox">
                  <label class="radio-inline"><input type="radio" name="genero" value='<?= set_radio('genero', 'm'); ?>'>Masculino</label>
                  <label class="radio-inline"><input type="radio" name="genero" value='<?= set_radio('genero', 'f'); ?>'>Feminino</label>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">Telefone</label>
                <input class="form-control" name="teletelefone" required></input>
              </div>

              <div class="form-group">
                <label class="control-label">Concelho</label>
                <select id="concelho_inst" class="form-control" name="concelho_inst">
                  <option value="one">-</option>
                  <option value="one">Lisboa</option>
                  <option value="two">Leiria</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label">Distrito</label>
                <select id="distrito_inst" class="form-control" name="distrito_inst">
                  <option value="one">-</option>
                  <option value="one">Lisboa</option>
                  <option value="two">Leiria</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label">Freguesia</label>
                <select id="freguesia_inst" class="form-control" name="freguesia_inst">
                  <option value="one">-</option>
                  <option value="one">Lisboa</option>
                  <option value="two">Leiria</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label">Habilitações Académicas</label>
                <select class="form-control" name="message">
                  <option value="one">-</option>
                  <option value="">Licenciatura</option>
                  <option value="">Mestrado</option>
                </select>
              </div>
            </div>