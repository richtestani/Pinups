$(document).ready(function() {
	
	
	//Groups Auto list
	//-----------------
	$('#group').keypress(function(e) {
		keys = e.target;
		var params = {}, li = '';

		if( $(keys).val().length >= 3 ) {
		
			params['value'] = $(keys).val();
			params['action'] = 'find';
			params['where_type'] = 'like';
			params['where_field'] = 'group';
			ul = '<ul id="autolist"></ul>';
			$('#group').after(ul);
			
			$.ajax({
			
				url: '/admin/ajax/action/find/groups',
				data: params,
				type: 'post',
				success: function(data) {
					
					result = $.parseJSON(data);
					$('#autolist li').remove();
					
					$(result).each(function(i) {
						li  += '<li class="autoitem" id="id_'+result[i].id+'"><a href="#">'+result[i].group+'</a></li>';
					});
					
					
					$('#autolist').html(li);
					$('#autolist li a').click(function(e) {
						
						console.log($(e.target).text());
						
					});
					
					
				}
			
			});
		}
		
	});
	
	//From URL checkbox
	//-----------------
	$('#from_url').click(function() {
	
		$('#url_input, #file_upload').toggle();
	
	});
	
	//Theme Selector
	//-----------------
	
});
