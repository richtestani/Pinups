<h1>Admin Dashboard</h1>
<div>
	Last uploaded
	<?php
	
	foreach ($pinups as $key => $value) {
		echo '<h1>'.$value->name.'</h1>';
		echo $value->file_name;
	}
	
	?>
</div>