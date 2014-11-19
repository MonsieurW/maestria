(function($) {
    var cuser = '';
    var d = false;

    $("select").change(function(e) {
        e.preventDefault();
        if(d === false) {
            d = true;
        }
        else {
            sendForm();
        }

        $("select option:selected").each(function() {
            str = $(this).val().trim();
        });

        $.get('/api/control/' + str + '/eval/' + $('#f').attr('data-id'), function(data) {
            $('#output').html(data);
        });
    }).change();

    $('body').delegate('a[data-toggle="tab"]', 'shown.bs.tab', function(e) {
        sendForm();
        $('#profil').val($(this).attr('href').replace('#u', ''));

    })

    $('body').delegate('button[data-toggle="popover"]', 'mouseenter', function(event) {
        $(this).popover('show');
    });

    $('body').delegate('button[data-toggle="popover"]', 'mouseleave', function(event) {
        $(this).popover('hide');
    });

    $('body').delegate('input[type=radio]', 'click', function(event) {
        sendForm();
    });

    $('form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            cache: false,
            url: $(this).attr('action'),
            data: $(this).serialize()
            //,success: function(msg) {
            //    console.log(msg);
            //}
        });
    });

    function sendForm() {
        $('#fSend').click(); // TODO : Make more visual on save (spinner)
    }

})(jQuery);