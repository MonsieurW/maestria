(function($) {

    $('.editable').editable({
        type: 'text',
        url: '/theme/',
        mode: 'inline'
    });

    $('.trash').click(function(event) {
    	event.preventDefault();

		$.ajax({
    		url: '/theme/',
    		type: 'POST',
    		dataType: 'html',
    		data: {
    			pk: $(this).attr('data-id'),
    			mode: 'delete'},
    	});
    });

    $('#save').click(function (e){
    	$.ajax({
    		url: '/theme/',
    		type: 'POST',
    		dataType: 'html',
    		data: {
    			value: $('#theme').val(),
    			mode: 'new'
    		},
    	});
    	
    });

})(jQuery);