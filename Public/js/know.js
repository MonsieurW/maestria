(function($) {

    $('.editable').editable({
        type: 'text',
        url: '/know/',
        mode: 'inline',
        sourceCache: true
    });

    $('.trash').click(function(event) {
    	event.preventDefault();

		$.ajax({
    		url: '/know/',
    		type: 'POST',
    		dataType: 'html',
    		data: {
                pk: $(this).attr('data-id'),
    			mode: 'delete'
            },
    	});
    });

    $('#save').click(function (e){
    	$.ajax({
    		url: '/know/',
    		type: 'POST',
    		dataType: 'html',
    		data: {
    			theme: $('#Qtheme').val(),
                domain: $('#Qdomain').val(),
                type: $('#Qtype').val(),
                level: $('#Qlevel').val(),
    			item: $('#Qitem').val(),
                mode: 'new'
    		},
    	});
    	
    });

/* Table initialisation */
    $('#example').dataTable();
    alert('ro');

})(jQuery);