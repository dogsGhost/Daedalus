<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="Framework from: http://github.com/inevitableIcarus/">
	<meta name="author" content="InevitableIcarus | David Zukowski">
	<meta name="viewport" content="width=device-width" />
	<?php 
	//Styles
	echo '<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">'."\n";
  	echo '<link href="'.URL_STYLES.'/main.less" rel="stylesheet" type="text/less">'."\n";
  	HTML_Helper::linkTag("bootstrap.min.css");
  	HTML_Helper::linkTag("bootstrap-theme.min.css");
	//Scripts
	HTML_Helper::scriptTag("jquery.js");
	HTML_Helper::scriptTag("main.js");
	HTML_Helper::scriptTag("less.js");
	HTML_Helper::scriptTag("bootstrap.min.js");
	?>
</head>
<body class="ddl">
	<div id="page" class="<?php echo $page; ?>">
		<header>
			<!--Sample nav bar provided from: http://getbootstrap.com/components/ -->
			<nav class="navbar navbar-default" role="navigation">
			  	<div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="#">Your Title</a>
			    </div>
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			      	<?php
			      		$links = ['Home', 'Products', 'About', 'Contact'];
			      		foreach($links as $link) {
			      			$class = (strtolower($link)==$page) ? 'active' : 'inactive';
			      			$href = URL_HOME;
			      			$href .= (strtolower($link) != "home") ? "/$link" : "";
			      			echo "<li class=\"$class\"><a href=\"".strtolower($href)."\">$link</a></li>\n";
			      		}
			      	?>
			      </ul>
			      <form class="navbar-form navbar-right" role="search">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-default">Submit</button>
			      </form>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		</header>
		<div id="content">
			<?php
				include $paths['views']."/$this->controller/$this->view.php";
				echo "\n"; //Formatting
			?>
		</div>
	</div>
	<footer>
	</footer>
</body>
</html>