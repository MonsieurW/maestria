(function($) {

    var inProgress = false;
    var elmt = [];
    var current = 0;
    $("select").change(function(e) {
    	e.preventDefault();

    	if(inProgress === false) {
        	inProgress = true;
            $("select option:selected").each(function() {
                str = $(this).val().trim();
            });
            
            $.get('/api/class/'+str, function (data) {
                elmt = jQuery.parseJSON(data);
        		updateCurentUser(0);

            })
		}
        else {
            sendForm();
        }
    }).change();

    $('form').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            cache: false,
            url: $(this).attr('action'),
            data: $(this).serialize(), 
            success: function(msg) {
                alert(msg);
            }
        });
    });

    $("#prevUser").click(function (e) {
    	e.preventDefault();
    	var i = current - 1;

    	if(i < 0)
    		i = 0;

        if(inProgress === false) {
            inProgress = true;
            updateCurentUser(i);
        }
        else {
            sendForm();
        }
    });

    $("#nextUser").click(function (e) {
    	e.preventDefault();
    	var i = current + 1;

    	if(i > elmt.length)
    		i = elmt.length;

        if(inProgress === false) {
            inProgress = true;
        	updateCurentUser(i);
        }
        else {
            sendForm();
        }
		
    });


    function updateCurentUser(i) {
    	if(i >= 0 && i <= elmt.length) {
    		current = i;
    		user    = elmt[i].user;
    		eval    = $('#f').attr('data-value');

    		$('#user').val(user);
    		$.get('/api/control/'+elmt[i].idProfil+'/eval/'+eval, function (data){
    			$('#output').html(data);
    		});
       	}
    }

    function sendForm() {
        $('#fSend').click();
    }



})(jQuery);