<?php echo  $profile_pic ?> 
<strong><?php echo $name ?></strong>
<?php echo $mood ?>
 <a href="<?=alink($config['base_url'].'main/status')?>">Set status/mood</a>
 <p>
 	<a href="<?=alink($config['base_url'].'')?>">Messages</a>
 </p>
 <span>
 	<a href="<?=alink($config['base_url'])?>">Notification</a>
 </span>
 <fieldset class="white-bg">
 
 
 	<ol>
    	<li><a href="<?=alink($config['base_url'])?>" class="bold-link1">My Friends</a></li>
        <li><a href="<?=alink($config['base_url'].'profile')?>" class="bold-link1">Profile</a></li>
        <li><a href="<?=alink($config['base_url'])?>" class="bold-link1">Posts</a></li>
        <li><a href="<?=alink($config['base_url'])?>" class="bold-link1">Photos</a></li>
        <li><a href="<?=alink($config['base_url'])?>" class="bold-link1">Privacy settings</a></li>
    </ol>
    <ul class="more-stuffs">
    <li><a href="<?=alink($config['base_url'].'chat')?>" class="bold-link1">Chat</a></li> |
    <li><a href="<?=alink($config['base_url'])?>" class="bold-link1">Blogs</a></li> |
     <li><a href="<?=alink($config['base_url'])?>" class="bold-link1">Hall of Frame</a></li> 
    </ul>
 
 
 </fieldset>

    rock.u changed his profile pic
<hr />
    
 <fieldset class="bg-box">
 
 
 	<strong>Connect</strong>
 <div>
 		<a href="<?=alink($config['base_url'])?>" class="bold-link">People</a> | 
        <a href="<?=alink($config['base_url'])?>" class="bold-link">Search</a>
  </div>
    <div class="people-may-know">
 
    <?php foreach ($peoples as $people): ?>
    <div>
    	<?= $people['pic'] ?><br />
 <a href="<?=alink($config['base_url'].'profile/index/'.$people['id'])?>" class="small-link"><?php echo $people['name'] ?></a>
 </div>
    
    <?php endforeach; ?>
    
   </div>
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

