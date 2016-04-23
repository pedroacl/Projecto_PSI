
    <div class="container">
      <form method="POST" action="login">
        <h2>Login</h2>
        <div class="form-group">
          <label for="inputEmail">Email address</label>
          <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        </div>
        <div class="form-group">
          <label for="inputPassword">Password</label>
          <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>
    </div>