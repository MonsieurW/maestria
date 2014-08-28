(function($) {
    var href = $(location).attr('href').replace('edit', 'update');

    $('#myModal').on('show.bs.modal', function(e) {
        $.get('/api/users', function(data) {
            $('#adduser').empty();
            var user = jQuery.parseJSON(data);
            for (var i = 0; i < user.length; i++) {
                $('#adduser').append('<option value="' + user[i].id + '">' + user[i].user + '</option>');
            }
        });
    })

    $('#save').click(function(event) {
        $.post(href, {
            id: $('#adduser').val(),
            mode: 'add'
        });
    });

    $('.remove').click(function(event) {
        alert(href);
        $.post(href, {
            id: $(this).parent().parent().attr('data-id'),
            mode: 'remove'
        });
    });

})(jQuery);