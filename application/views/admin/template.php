<html>
	<head>
		<title><?php echo $doc_title; ?> | Pinups Gallery Admin</title>
		<link href="<?php echo $lobster; ?>" type="text/css" rel="stylesheet" media="screen" />
		<link href="<?php echo $grid; ?>" type="text/css" rel="stylesheet" media="screen" />
		<link href="<?php echo $styles; ?>" type="text/css" rel="stylesheet" media="screen" />
		<script language="javascript" src="<?php echo $jquery; ?>"></script>
		<script language="javascript" src="<?php echo $jqueryui; ?>"></script>
	</head>
	<body>
		<header>
			<div class="layout">
				<div id="logo">
					<img src="<?php echo $logo; ?>" />
				</div>
				<nav>
					<ul>
					<?php
					foreach ($nav as $key => $value) {
						echo '<li><a href="'.$value['href'].'"';
						
						echo '>'.$value['label'].'</a></li>';
					}
					?>
					</ul>
				</nav>
				<nav id="subnav">
					<ul>
						<?php
							if(isset($subnav) && !empty($subnav)) {
								foreach ($subnav as $key => $value) {
									echo '<li><a href="'.$value['href'].'"';
									
									echo '>'.$value['label'].'</a></li>';
								}
							}
						?>
					</ul>
				</nav>
			</div>
		</header>
		<div id="content">
			<div class="layout">
				<section>
					<?php
						if(isset($error)) {
							echo '<span class="error">'.$error.'</span>';
						}
					?>
					<?php echo $content; ?>
				</section>
				<aside>
					<?php
						if(isset($img_tag)) {
							extract($upload_data);
							echo $img_tag;
						}
					?>
				</aside>
			</div>
		</div>
		<script language="javascript" src="<?php echo $scripts; ?>"></script>
	</body>
</html>