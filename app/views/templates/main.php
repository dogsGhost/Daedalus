<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="Framework from: http://github.com/inevitableIcarus/">
	<meta name="author" content="InevitableIcarus">
	<meta name="viewport" content="width=device-width" />
	<?php 
	//Styles
	echo '<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">'."\n";
  	echo '<link href="'.URL_STYLES.'/main.less" rel="stylesheet" type="text/less">'."\n";
	//Scripts
	HTML_Helper::scriptTag("jquery.js");
	HTML_Helper::scriptTag("main.js");
	HTML_Helper::scriptTag("less.js");
	?>
</head>
<body>
	<div id="page" class="<?php echo $page; ?>">
		<header>
		</header>
		<div id="content">
			<?php
				include $paths['views']."/$this->controller/$this->view.php";
				echo "\n"; //Formatting
			?>
		</div>
	</div>
</body>
</html>