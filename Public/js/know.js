(function($) {

    $('.editable').editable({
        type: 'text',
        url: '/know/',
        mode: 'inline'
    });

    $('.trash').click(function(event) {
    	event.preventDefault();

		$.ajax({
    		url: '/know/',
    		type: 'POST',
    		dataType: 'html',
    		data: {
    			pk: $(this).attr('data-id'),
    			mode: 'delete'},
    	});
    });

    $('#save').click(function (e){
    	$.ajax({
    		url: '/know/',
    		type: 'POST',
    		dataType: 'html',
    		data: {
    			theme: $('#theme').val(),
                domain: $('#domain').val(),
                type: $('#type').val(),
                level: $('#level').val(),
    			item: $('#item').val()
    		},
    	});
    	
    });

})(jQuery);