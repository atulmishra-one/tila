<a name="top"></a>
<strong>Common room</strong>
<fieldset class="bg-box">

	<form method="post">
    	<small class="small-label">Message:</small><br />
		 <textarea name="msg" maxlength="200"></textarea>
        <input type="submit" name="btn" value="Send" />
        <br />
        <a href="<?=alink($config['base_url'].'chat/common')?>" class="small-link">Refresh</a> |
        <a href="<?=alink($config['base_url'].'chat/common')?>" class="small-link">Smilies List</a>
    </form>
    
    <hr />
    
    	<?php foreach( $msgs as $msg ) : ?>
        
        
 
      <a href="<?=alink($config['base_url'].'profile/'.$msg['chatter_id'])?>" class="bold-link"><?= $msg['name'] ?></a>
      
      &nbsp;<font size="1"><?=$msg['time']?></font>
      &nbsp;&raquo;&nbsp; <span class="chat-msgs"><?php echo  $msg['msg']  ?></span>
      <div id="clear"></div> 
      
    
    <?php endforeach;?>
    
    
 <hr />
 <a href="<?=alink($config['base_url'].'chat/common')?>#top">Top</a>
</fieldset>