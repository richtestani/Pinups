<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

	Main Thumbnails
	Settings for default output.
	If clipped is true, images will be scaled to
	size of largest dimension and cropped on other dimension.
	

*/
$config['thumb']['width']	= '200px';
$config['thumb']['height']	= '298px';
$config['thumb']['width']	= '200';
$config['thumb']['height']	= '298';
$config['thumb']['crop']	= true;
$config['thumb']['prefix']	= 't_';
$config['thumb']['suffix'] = '';

/*

	Pinups Settings
*/
$config['pinups']['quality'] = '80';

/*

	Image Sizes
	Sizes represent widths by their proportional height

*/
$config['size']['small'] 	= '100';
$config['size']['medium'] 	= '300';
$config['size']['large'] 	= '500';
$config['size']['xlarge'] 	= '800';

/*
	Upload Settings
*/
$config['upload']['upload_path'] = '/uploads/';	//from root folder (include trailing slash)s
$config['upload']['allowed_types'] = 'gif|jpg|png|tif|tiff|jpeg|bmp';
$config['upload']['max_size']	= '5000';	//in KB
$config['upload']['max_width'] = '0';
$config['upload']['max_height'] = '0';
$config['upload']['max_filename'] = '0';
$config['upload']['encrypt_name'] = false;
$config['upload']['remove_spaces'] = true; //leave as true

/*
	Image Settings
*/
$config['image']['jpg_quality'] = '80';
$config['image']['noise']	= 0;
$config['image']['sharpen'] = 0;

/*
	Theme Settings
*/
$config['themes']['theme_preview'] 			= 'preview.png';

/*
	Storage Settings
*/
$config['storage']['driver'] = 'local';

/*
	Pagination
*/
$config['pages']['total_rows'] = 800;
$config['pages']['base_url'] = 'http://dev.themoviepostersite.com/page/';
$config['pages']['per_page'] = 48;
$config['pages']['num_links'] = 10;
$config['pages']['use_page_numbers'] = true;
$config['pages']['page_query_string'] = false;
$config['pages']['full_tag_open'] = '<span class="page_link">';
$config['pages']['full_tag_close'] = '</span>';
$config['pages']['first_link'] = 'First';
$config['pages']['first_tag_open'] = '<span>';
$config['pages']['first_tag_close'] = '</span>';
$config['pages']['last_link'] = 'Last';
$config['pages']['last_tag_open'] = '<span>';
$config['pages']['last_tag_close'] = '</span>';
$config['pages']['next_link'] = '&gt;';
$config['pages']['next_tag_open'] = '<span>';
$config['pages']['next_tag_close'] = '</span>';
$config['pages']['prev_tag_open'] = '<span>';
$config['pages']['prev_tag_close'] = '</span>';
$config['pages']['cur_tag_open'] = '<b>';
$config['pages']['cur_tag_close'] = '</b>';
$config['pages']['num_tag_open'] = '<span>';
$config['pages']['num_tag_close'] = '</span>';
$config['pages']['display_pages'] = true;

$config['pages']['uri_segment'] =2; //?

