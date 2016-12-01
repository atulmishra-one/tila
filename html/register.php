<p> <strong>Join Rocktila , Discover a Cool and Happening Chat</strong> </p>
<?php echo flash(); echo $errors; ?>
<fieldset>
	<legend><strong> Join for free </strong></legend>
  <span class="form">
  <form method="post" action="<?=$config['base_url']?>auth/register">
    	<li><small>Userame</small></li>
    	<li><input type="text" name="u" /></li>
        <li><small>Password</small></li>
        <li><input type="password" name="p" /></li>
        <li><small>Gender</small></li>
        <li><select name="gender"><option value="M">Male</option><option value="F">Female</option></select></li>
        <li><small>Birthday</small></li>
        <li><input type="text" name="dob" /> <font size="1"> <i>( format YYYY-MM-DD) </i> </font></li>
        <li><input type="submit" name="btn" value="Sign up" /></li>
   </form>
  </span>
  	
</fieldset>