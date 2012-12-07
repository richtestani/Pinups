<html>
<head>
	<title><?php echo $page_title; ?></title>
	<link href="<?php echo $ostrich; ?>" type="text/css" rel="stylesheet" media="screen" />
	<link href="<?php echo $styles; ?>" type="text/css" rel="stylesheet" media="screen" />
</head>
<body>
	<div id="wrapper">
		<?php echo $header; ?>
		<div id="content">
			<?php echo $content; ?>
			<div id="pagination">
				<?php echo $page_links; ?>
			</div>
		</div>
		<?php echo $footer; ?>
	</div>
</body>
</html>