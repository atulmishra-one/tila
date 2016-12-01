<?php echo flash(); ?>
<strong>Set what&rsquo;s your mood</strong>
<p>
<a href="<?php echo alink($config['base_url'].'main') ?>">&laquo; Back</a>

	<form method="post">
    	<input type="text" name="status" /> <input type="submit" name="btn" value="Save" />
    </form>
 </p>
