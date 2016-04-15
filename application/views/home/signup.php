
  <form class="form-signin" action="login/login">
    <h2 class="form-signin-heading">Registar Voluntário</h2>
    <label for="inputEmail" class="sr-only">Email address</label>

    <div class="form-group">
      <label for="inputEmail" class="control-label">Email</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    </div>

    <div class="form-group">
      <label class="control-label">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    </div>

    <div class="form-group">
      <label class="control-label">Tipo de Utilizador</label>
      <select class="form-control" name="message">
        <option id="default_user_select" value="one" selected>-</option>
        <option id="volunteer_select" value="one">Voluntário</option>
        <option id="institution_select" value="two">Instituição</option>
      </select>
    </div>

    <div class="volunteer_fields">
      <div class="form-group">
        <label class="control-label">Nome</label>
        <input class="form-control" name="name" placeholder="Nome Completo"></input>
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
        <div class='input-group date' id='datetimepicker1'>
          <input type='text' class="form-control" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
          </div>
      </div>

      <div class="form-group">
        <label class="control-label">Telefone</label>
        <input class="form-control" name="message"></input>
      </div>

      <div class="form-group">
        <label class="control-label">Área Geográfica</label>
        <select class="form-control" name="message">
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

<script type="text/javascript">
  $(function () {
    $('#datetimepicker1').datetimepicker();
  });
</script>