<div class="container">
  <form class="form-signin" action="" method="POST">
    <h2 class="form-signin-heading">Registar Voluntário</h2>
    <label for="inputEmail" class="sr-only">Email address</label>

    <div class="form-group">
      <label for="inputEmail" class="control-label">Email</label>
      <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    </div>

    <div class="form-group">
      <label class="control-label">Password</label>
      <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    </div>

    <div class="form-group">
      <label class="control-label">Confirmação da Password</label>
      <input name="password_confirmation" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    </div>

    <div class="form-group">
      <label class="control-label">Tipo de Utilizador</label>
      <select name="user_type" id="user_type_select" class="form-control">
        <option id="default_user_select" value="none" selected>-</option>
        <option id="volunteer_select" value="volunteer">Voluntário</option>
        <option id="institution_select" value="institution">Instituição</option>
      </select>
    </div>

    <div id="user_form_end"></div>

    <!-- Campos de um Voluntario -->

    <div class="volunteer_fields">
      <div class="form-group">
        <label class="control-label">Nome</label>
        <input name="name" class="form-control" placeholder="Nome Completo"></input>
      </div>

      <div class="form-group">
        <label class="control-label">Género</label>
        <div class="checkbox">
          <label class="radio-inline"><input type="radio" name="gender" value="m">Masculino</label>
          <label class="radio-inline"><input type="radio" name="gender" value="f">Feminino</label>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label">Data de Nascimento</label>
        <div class='input-group date' data-provide="datepicker" class='datepicker'>
          <input type='text' class="form-control" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
          </div>
      </div>


      <div class="form-group">
        <label class="control-label">Telefone</label>
        <input name="phone_number" class="form-control"></input>
      </div>

      <div class="form-group">
        <label class="control-label">Área Geográfica</label>
        <select id="geographic_areas" class="form-control" name="message">
          <option value="one">-</option>
          <option value="one">Lisboa</option>
          <option value="two">Leiria</option>
        </select>
      </div>

      <div class="form-group">
        <label class="control-label">Habilitações Académicas</label>
        <select class="form-control" name="message">
          <?php foreach ($academic_qualifications as $academic_qualification) { ?>
            <option value="one">-</option>
            <option value="<?php echo $academic_qualification->key ?>">
              <?php echo $academic_qualification->value ?>
            </option>
          <?php } ?>
        </select>
      </div>
    </div>


    <!-- Campos de um Instituiçao -->

    <div class="institution_fields">
      <div class="form-group">
        <label class="control-label">Nome</label>
        <input class="form-control" name="name" placeholder="Nome Completo" required></input>
      </div>

      <div class="form-group">
        <label class="control-label">Género</label>
        <div class="checkbox">
          <label class="radio-inline"><input type="radio" name="gender" value="m">Masculino</label>
          <label class="radio-inline"><input type="radio" name="gender" value="f">Feminino</label>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label">Telefone</label>
        <input class="form-control" name="telephone_number" required></input>
      </div>

      <div class="form-group">
        <label class="control-label">Área Geográfica</label>
        <select class="form-control" name="geographic_area">
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

    <button class="btn btn-lg btn-primary btn-block" type="submit">Registar</button>
  </form>
</div>