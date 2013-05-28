<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if( isset( $refresh) && !empty($refresh) ):?>
<meta http-equiv="refresh" content="120; URL=<?php echo $refresh; ?>"/>
<?php endif;?>
<title><?php echo $title ?></title>
<link rel="stylesheet" href="<?php echo $config['base_url']?>public/css/common.css" />
</head>

<body>
		<div id="wrapper">
        	<div id="header"></div>
            	<div id="content"> <?php echo $content; ?></div>
            <div id="footer">
              <ul class="footer-list">
            	<?php foreach($footer_links as $lkey => $links ) : ?>
                	<li> &raquo; <a href="<?=$lkey?>"><?=$links?></a> </li>
                <?php endforeach; ?>
              </ul>
					<p> <?php echo $footer; ?> </p>
            </div>
        </div>
</body>
</html>