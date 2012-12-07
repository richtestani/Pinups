<section class="listing">
		<?php
			foreach ($pinups as $key => $value) {
				echo '<article class="image_thumb">';
				echo '<a href="/images/id/'.$value->pinup_id.'">';
				echo '<img src="'.$upload_path.$value->path_to_file.$value->thumbnail.'" />';
				echo '</a>';
				echo '<div class="image_group">';
				echo $value->group;
				echo '</div>';
				echo '</article>';
			}
		?>
</section>
