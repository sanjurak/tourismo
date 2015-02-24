$(document).ready(function(){

	$("#categoriesSelect").selectize({
        valueField: 'name',
        labelField: 'name',
        searchField: ['name'],
        options: [],
        preload: true,
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.name)+'</div>';
            }
        },
        optgroups: [
            {value: 'categories', label: 'Kategorija'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['categories'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'autocompleteTrvlDlsCat',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query,
                    dst: $("#dstCountryTownSelect")[0].value
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        },
        onChange: function(){
            var term = this.items[0];
            SearchExcursions(term, $("#dstCountryTownSelect")[0].value,
                $("#from_date")[0].value, $("#to_date")[0].value);
        }
    });

	$("#dstCountryTownSelect").selectize({
        valueField: 'name',
        labelField: 'name',
        searchField: ['name'],
        options: [],
        preload: true,
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.name)+'</div>';
            }
        },
        optgroups: [
            {value: 'destination', label: 'Destinacija'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['destinations'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'autocompleteTrvlDlsDst',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query,
                    cat: $("#categoriesSelect")[0].value
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        },
        onChange: function(){
            var term = this.items[0];
            SearchExcursions($("#categoriesSelect")[0].value, term,
                $("#from_date")[0].value, $("#to_date")[0].value);
        }
    });

	$("#bresetTrvlDls").click(function(){
        var selectize = $("#categoriesSelect")[0].selectize;
        selectize.clear();
        selectize.clearOptions();
        selectize = $("#dstCountryTownSelect")[0].selectize;
        selectize.clear();
        selectize.clearOptions();
        $("#from_date")[0].value = "";
        $("#to_date")[0].value = "";
        SearchExcursions("", "", "", "");        
    });

    $("#dstCountryTownSelect").click(function(){
        var selectize = $('#dstCountryTownSelect')[0].selectize;
        selectize.load();
    });

    $('#from_date').datepicker();
    $('#from_date').datepicker( "option", "dateFormat", 'd-m-yy' );

    $('#to_date').datepicker();
    $('#to_date').datepicker( "option", "dateFormat", 'd-m-yy' );

    $('#searchBtn').click(function(){
        SearchExcursions($("#categoriesSelect")[0].value,
                        $("#dstCountryTownSelect")[0].value,
                        $("#from_date")[0].value,
                        $("#to_date")[0].value);
    });
});