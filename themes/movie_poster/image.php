<section id="single">
	<article>
		<h1><?php echo $pinups->group;
		echo (!empty($pinups->title)) ? ' ('.$pinups->title.')' : ''; ?></h1>
		<div class="image">
			<img src="<?php echo $image_path.$pinups->filename; ?>" />
		</div>
	</article>
</section>