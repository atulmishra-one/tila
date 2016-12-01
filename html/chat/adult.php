<a name="top"></a>
<strong>Adult Chat room</strong>
<fieldset class="bg-box">
<p>
	<form method="post">
    	<small class="small-label">Message:</small><br />
		 <textarea name="msg" maxlength="250"></textarea>
        <input type="submit" name="btn" value="Send" />
        <br />
        <a href="<?=alink($config['base_url'].'chat/adult')?>" class="small-link">Refresh</a> |
        <a href="<?=alink($config['base_url'].'chat/adult')?>" class="small-link">Smilies List</a>
    </form>
    
    <hr />
    
    <?php foreach( $msgs as $msg ) : ?>
   <ul class="trim-list">
    <li>
      <a href="<?=alink($config['base_url'].'profile/'.$msg['chatter_id'])?>" class="bold-link"><?= $msg['name'] ?></a>
      &nbsp;<font size="1"><?=$msg['time']?></font>
      &nbsp;&raquo; &nbsp; 
      <?=  $msg['msg']?>
      
    </li>
   </ul>
    <?php endforeach;?>
 </p>
 <hr />
 <a href="<?=alink($config['base_url'].'chat/adult')?>#top">Top</a>
</fieldset>