(function($) {

    var input;
    $('.choose').click(function(e) {
        e.preventDefault();

        $('#myModal').modal('show');
        input = $(this).parent().prev();
    });

    $('body').delegate('.c', 'click', function(e) {
        e.preventDefault();
        
        var id = $(this).attr('data-id');
        var co = $(this).children().last().html();

        input.val(id+'|'+co);
        $('#myModal').modal('hide');
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        e.preventDefault();
        var id = $(this).attr('href');
        var identifier = id.replace('#', '');

        if ($(id).html() == '') {
            $.ajax({
                type: 'POST',
                cache: false,
                url: '/api/know',
                dataType: 'json',
                data: {
                    domain: identifier
                },
                success: function(msg) {
                    var html = '<table class="table table-condensed table-hover">' +
                        '<thead><tr>' +
                        '<td>Theme</td>' +
                        '<td>Niveau</td>' +
                        '<td>Item</td>' +
                        '</tr></thrad>' +
                        '<tbody>';
                    for (i = 0; i < msg.length; i++) {
                        html += '<tr class="c" data-id="' + msg[i].idConnaissance + '"><td>' + msg[i].themeValue + '</td><td>' + msg[i].lvl + '</td><td>' + msg[i].item + '</td></tr>';
                    }

                    html += '</tbody></table>';

                    $(id).html(html);

                }
            });
        }


    })

})(jQuery);