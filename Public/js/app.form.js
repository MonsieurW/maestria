(function($) {

    function question(i) {

        var q = '<div class="form-group">' +
            '<label for="inputEmail3" class="col-sm-2 control-label"></label>' +
            '<div class="col-sm-5 borde">' +
            '    <div class="row">' +
            '        <div class="col-sm-10">' +
            '            <input type="text" name="q' + i + '_title" class="form-control" id="inputEmail3" placeholder="Titre">' +
            '        </div>' +
            '        <div class="col-sm-2">' +
            '            <input type="text" name="q' + i + '_note" class="form-control" id="inputEmail3" placeholder="Note">' +
            '        </div>' +
            '    </div>' +
            '    <div class="row" style="margin-top: 5px">' +
            '        <div class="col-sm-6">' +
            '            <input type="text" name="q' + i + '_item1" class="typeahead form-control" placeholder="Item 1" />' +
            '        </div>' +
            '        <div class="col-sm-6">' +
            '            <input type="text" name="q' + i + '_item2" class="typeahead form-control" placeholder="Item 2" />' +
            '        </div>' +
            '    </div>' +
            '</div>' +
            '</div>';

        return q;
    }

    var states = '';
    $.ajax({
        url: "/api/cap",
        async: false,
        dataType: "json"
    }).done(function(d) {
        states = d;
    });

    var states = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: states
    });

    // kicks off the loading/processing of `local` and `prefetch`
    states.initialize();

    $('.typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'states',
        displayKey: 'value',
        // `ttAdapter` wraps the suggestion engine in an adapter that
        // is compatible with the typeahead jQuery plugin
        source: states.ttAdapter(),
        templates: {
            empty: [
                '<div class="alert alert-danger">',
                'unable to find any Best Picture winners that match the current query',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile('<p><strong>{{value}}</strong> – {{year}} - {{tokens}}</p>')
        }
    });




})(jQuery);