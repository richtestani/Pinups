<html>
<head>
	<title><?php echo $pinups->group;
	echo (!empty($pinups->title)) ? ' ('.$pinups->title.')' : ''; ?> || The Movie Poster Site</title>
	<link href="<?php echo $ostrich; ?>" type="text/css" rel="stylesheet" media="screen" />
	<link href="<?php echo $styles; ?>" type="text/css" rel="stylesheet" media="screen" />
</head>
<body>
	<div id="wrapper">
		<?php echo $header; ?>
		<div id="content">
			<?php echo $content; ?>
		</div>
		<?php echo $footer; ?>
	</div>
</body>
</html>