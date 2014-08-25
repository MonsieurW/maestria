(function($) {

    $('.editable').editable({
        type: 'text',
        url: '/classroom/',
        mode: 'inline'
    });

    $('.trash').click(function(event) {
    	event.preventDefault();

		$.ajax({
    		url: '/classroom/',
    		type: 'POST',
    		dataType: 'html',
    		data: {
    			pk: $(this).attr('data-id'),
    			mode: 'delete'},
    	});
    });

    $('#save').click(function (e){
    	$.ajax({
    		url: '/classroom/',
    		type: 'POST',
    		dataType: 'html',
    		data: {
    			value: $('#classroom').val(),
    			mode: 'new'
    		},
    	});
    	
    });

})(jQuery);