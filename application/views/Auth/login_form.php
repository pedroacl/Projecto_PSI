<?php
$username = array(
	'name'	=> 'username',
	'id'	=> 'username',
	'size'	=> 30,
	'value' => set_value('username')
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30
);

$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0'
);

$confirmation_code = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8
);

?>

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