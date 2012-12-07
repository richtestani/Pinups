<h1>Upload an Image</h1>
<div>
	Last uploaded
</div>
<?php echo $message['warning']; ?>
<?php echo $message['error']; ?>
<?php if(!empty($message)): ?>
<?php echo form_open_multipart('/admin/uploader/do_upload'); ?>
<?php echo form_label('group'); ?>
<?php echo form_input(array('name'=>'group', 'id'=>'group')); ?>
<?php echo form_label('title'); ?>
<?php echo form_input(array('name'=>'title', 'id'=>'title')); ?>
<?php echo form_label('tags'); ?>
<?php echo form_input( array('name'=>'tags', 'id'=>'tags') ); ?>
<?php echo form_label('image catgories'); ?>
<ul>
<?php
	foreach ($categories as $key => $value) {
		echo '<li>';
		echo form_label($value['name']);
		echo form_checkbox('categories[]', $value['id']);
		echo '</li>';
	}
?>
</ul>
<?php
	if($curl_support) {
		echo form_label('Upload from URL');
		echo form_checkbox(array(
								'name'=>'from_url',
								'id'=>'from_url',
								'value'=>1
								));
		echo '<div id="url_input">';
		echo form_input( array('name'=>'url', 'id'=>'url') );
		echo '</div>';
	}
?>
<div id="file_upload">
	<input type="file" name="userfile" size="20" />
</div>
<?php echo form_submit(array('value'=>'upload')); ?>
<?php echo form_close(); ?>
<?php endif; ?>
<?php

?>