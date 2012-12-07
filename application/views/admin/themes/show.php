
<ul>
<?php
echo '<h1>'.$page_title.'</h1>';
?>
<div id="selected_theme">
	<h2>Selected Theme: <?php echo $current_theme; ?></h2>
</div>
<h2>Installed Themes</h2>
<?php

foreach($themes as $key => $val) {
	if($current_theme != $val) {
		echo '<li>'.humanize($val).'</li>';
		$path = '.'.$theme_location.'/'.$val.'/'.$theme_preview;
		if( file_exists( $path ) ) {
		
			echo '<img src="'.base_url().$theme_location.'/'.$val.'/'.$theme_preview.'" />';
			
		}
	}
	
}?>
</ul>