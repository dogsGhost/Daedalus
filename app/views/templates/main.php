<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="Framework from: http://github.com/inevitableIcarus/">
	<meta name="author" content="David Zukowski">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="<?php echo URL_STYLES;?>/main.less" rel="stylesheet" type="text/less">
	<?php 
	HTML_Helper::scriptTag("jquery.js");
	HTML_Helper::scriptTag("main.js");
	HTML_Helper::scriptTag("less.js");
	?>
</head>
<body id="daedalus">
	<div id="page" class="<?php echo $page; ?>">
		<header>
		</header>
		<div id="content">
			<?php
				include VIEWS_DIR."/$view.php";
				echo "\n"; //Formatting
			?>
		</div>
		<footer>
		</footer>
	</div>
</body>
</html>