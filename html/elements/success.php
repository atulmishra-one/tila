<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<link rel="stylesheet" href="<?php echo $config['base_url']?>public/css/common.css" />
<style>
<!--
h3{ margin:0;}
#content .txt{ color:#090;}
-->
</style>
</head>

<body>
		<div id="wrapper">
        	<div id="header"><h3>Success</h3></div>
            	<div id="content"> <?php echo $content; ?>
                		<?php foreach($links as $lkey => $link ) : ?>
                	<li> <a href="<?=$lkey?>"><?=$link?></a> </li>
                <?php endforeach; ?>
                </div>
            <div id="footer">
            	Copyright &copy; 2013 | Rocktila.com &trade;
            </div>
        </div>
</body>
</html>