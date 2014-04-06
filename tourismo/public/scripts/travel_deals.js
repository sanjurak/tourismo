$(document).ready(function(){

	$("#categoriesSelect").selectize({
        valueField: 'name',
        labelField: 'name',
        searchField: ['name'],
        options: [],
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
            SearchTrvlDls(term, $("#dstCountryTownSelect")[0].value);
        }
    });

	$("#dstCountryTownSelect").selectize({
        valueField: 'name',
        labelField: 'name',
        searchField: ['name'],
        options: [],
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
            SearchTrvlDls( $("#categoriesSelect")[0].value, term);
        }
    });

	$("#bresetTrvlDls").click(function(){
        var selectize = $("#categoriesSelect")[0].selectize;
        selectize.clear();
        selectize.clearOptions();
        selectize = $("#dstCountryTownSelect")[0].selectize;
        selectize.clear();
        selectize.clearOptions();
        SearchTrvlDls("", "");        
    });


});