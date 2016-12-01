
<fieldset>
<?php echo flash(); ?>
	<legend><strong> Login </strong></legend>
  <span class="form">
  <form method="post" action="" >
    	<li><small>Userame</small></li>
    	<li><input type="text" name="u" /></li>
        <li><small>Password</small></li>
        <li><input type="password" name="p" /></li>
        <li><input type="checkbox" name="remember" value="1" />&nbsp;<small>Remember me</small></li>
        <li><input type="submit" name="btn" value="Login" /></li>
    </form>
  </span>
  	<a href="<?=$config['base_url']?>auth/forgot">Forgot password?</a>
</fieldset>