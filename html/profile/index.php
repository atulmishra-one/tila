 <?php echo flash() ?>
 <?php if( $frens['hasRequestFromThis'] ) : ?>
    		<a href="<?=alink($config['base_url'])?>" class="bold-link1">Respond to Friend request</a><br />
 <?php elseif( $frens['hasRequested']) :  ?>
 	<div class="error">Friend request sent</div>
 <?php endif; ?>
    
<strong><?php echo $name ?></strong><br />
<?php echo  $profile_pic ?>
<div class="faded"> &nbsp;&nbsp; <?php echo $info[0]['username'] ?></div>
&nbsp;<?php echo $age, ' year, ',$sex, ',&nbsp;', $country ?>
<p>
	<?php echo $info[0]['mood'] ?>
</p>

<?php if( $isOwner ) : ?>
<div><a href="<?=alink( $config['base_url'].'profile/profile_pic')?>">Change profile photo</a></div>
<?php endif; ?>
 
 
 	<ol>
    
    
    
    <?php if( $isOwner ) : ?>
        <li><a href="<?=alink($config['base_url'])?>" class="bold-link1">Update Info</a></li>
    <?php endif; ?>
    
    
    
   <?php if( (bool)$frens['areFriends'] === false and (bool)$frens['hasRequestFromThis'] === false and (bool)$frens['hasRequested'] === false) : ?>
   		<li><a href="<?=alink($config['base_url'].'profile/addFriend/'.$info[0]['id'])?>" class="bold-link1">Add Friend</a></li>
    <?php endif; ?>
    
    	<li><a href="<?=alink($config['base_url'])?>" class="bold-link1">Send Message</a></li>
    	<li><a href="<?=alink($config['base_url'])?>" class="bold-link1">Friends</a></li>
        <li><a href="<?=alink($config['base_url'])?>" class="bold-link1">Posts</a></li>
        <li><a href="<?=alink($config['base_url'])?>" class="bold-link1">Photos</a></li>
    </ol>
 
 
 
    <hr />
    
 <fieldset class="bg-box">
 
 
    
   <div id="clear"></div>
   <div>
   		Quick Search
        <form>
        	<input type="text" name="q" /><i class="help-block">Enter name, Id or keyword</i>
            <input type="submit" value="Submit" />
        </form>
   </div>
   <hr />
   
 </fieldset>

