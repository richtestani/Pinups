<section id="single">
	<article>
		<h1><?php echo $pinups->group;
		echo (!empty($pinups->title)) ? ' ('.$pinups->title.')' : ''; ?></h1>
		<div class="image">
			<img src="<?php echo $upload_path.$pinups->path_to_file.$size.'/'.$pinups->filename; ?>" />
		</div>
	</article>
</section>