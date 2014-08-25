(function($) {

    $('.editable').editable({
        type: 'text',
        url: '/domain/',
        mode: 'inline'
    });

    $('.trash').click(function(event) {
    	event.preventDefault();

		$.ajax({
    		url: '/domain/',
    		type: 'POST',
    		dataType: 'html',
    		data: {
    			pk: $(this).attr('data-id'),
    			mode: 'delete'}
    	});
    });

    $('#save').click(function (e){
    	$.ajax({
    		url: '/domain/',
    		type: 'POST',
    		dataType: 'html',
    		data: {
    			value: $('#domain').val(),
    			mode: 'new'
    		},
    	});
    	
    });

})(jQuery);