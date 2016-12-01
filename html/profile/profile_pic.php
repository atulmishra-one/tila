<strong>Upload your profile picture</strong>

	<?php echo flash() ?>
<p>

<form method="post" enctype="multipart/form-data">
	<input type="file" name="img" />
    <i class="help-block">256kb Maximum size, allowed ,jpeg, .jpg, .png, .gif</i>
   Share: <select name="notify_to">
   	<option value="P">Public</option>
    <option value="F">Friends</option>
    <option value="M">Only me</option>
   </select><br />
    <input type="submit" name="btn"  value="Upload" />
</form>

</p>

<a href="<?=alink($config['base_url'].'profile')?>" class="bold-link1"> &laquo; Back</a>