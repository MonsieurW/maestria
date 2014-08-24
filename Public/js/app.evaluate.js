(function($) {

    var inProgress = false;
    var elmt = [];
    var current = 0;
    $("select").change(function(e) {
        e.preventDefault();

        if (inProgress === false) {
            inProgress = true;
            $("select option:selected").each(function() {
                str = $(this).val().trim();
            });

            $.get('/api/class/' + str, function(data) {
                elmt = jQuery.parseJSON(data);
                updateCurentUser(0);

            })
        } else {
            sendForm();
        }
    }).change();

    $('form').submit(function(e) {
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

    $("#prevUser").click(function(e) {
        e.preventDefault();
        var i = current - 1;

        if (i < 0)
            i = 0;

        if (inProgress === true) {
            inProgress = false;
            sendForm();
        }
        updateCurentUser(i);
    });

    $("#nextUser").click(function(e) {
        e.preventDefault();
        var i = current + 1;

        if (i > elmt.length)
            i = elmt.length;


        if (inProgress === true) {
            inProgress = false;
            sendForm();
        }
        updateCurentUser(i);


    });


    function updateCurentUser(i) {
        inProgress = true;
        if (i >= 0 && i <= elmt.length) {
            current = i;
            user = elmt[i].user;
            id = elmt[i].idProfil;
            eval = $('#f').attr('data-value');

            $('#profil').val(id);
            $('#user').val(user);
            $.get('/api/control/' + id + '/eval/' + eval, function(data) {
                $('#output').html(data);
            });
        }
    }

    function sendForm() {
        $('#fSend').click();
    }



})(jQuery);