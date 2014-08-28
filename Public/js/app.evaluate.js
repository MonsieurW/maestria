(function($) {
    $("select").change(function(e) {
        e.preventDefault();
            $("select option:selected").each(function() {
                str = $(this).val().trim();
            });

            $.get('/api/control/' + str+'/eval/'+$('#f').attr('data-id'), function(data) {
                $('#fSend').click();
                $('#output').html(data);
            });
    }).change();

    $('body').delegate('a[data-toggle="tab"]', 'shown.bs.tab', function (e) {
        $('#fSend').click();
    })


    $('form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            cache: false,
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(msg) {
                console.log(msg);
            }
        });
    });

    function sendForm() {
        $('#fSend').click();
    }



})(jQuery);