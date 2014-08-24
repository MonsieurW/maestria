(function($) {

    var classe = '';
    $.ajax({
        url: "/api/class/",
        async: false,
        dataType: "json"
    }).done(function(d) {
        classe = d;
    });


    var classroom = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: classe
    });
    classroom.initialize();

    $('.typeclass').tagsinput({
        typeaheadjs: {
            name: 'classroom',
            displayKey: 'value',
            valueKey: 'value',
            source: classroom.ttAdapter()
        }
    });

    var domain = '';
    $.ajax({
        url: "/api/domain/",
        async: false,
        dataType: "json"
    }).done(function(d) {
        domain = d;
    });


    var d = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('domainValue'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: domain
    });
    d.initialize();

    $('.typedomain').tagsinput({
        typeaheadjs: {
            name: 'domain',
            displayKey: 'domainValue',
            valueKey: 'domainValue',
            source: d.ttAdapter()
        }
    });

})(jQuery);