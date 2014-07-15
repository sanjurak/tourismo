$(function(){

	$("#res_filter").selectize({
        valueField: 'id',
        labelField: 'term',
        searchField: ['term'],
        options: [],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.term)+'</div>';
            }
        },
        optgroups: [
            {value: 'resnum', label: 'Broj rezervacije'},
            {value: 'passanger', label: 'Putnik'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['resnum','passanger'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'autocompleteRES',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
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
            $.ajax({
		url:"searchRes",
		type:"POST",
		data: {search_item: term },
		dataType:"html",
		success: function(data){
			$("#reservationsPartial").empty().html(data);
		}
	});
        }
    });
    
    $("#bresetRes").click(function(){
    	var selectize = $("#res_filter")[0].selectize;
		selectize.clear();
		selectize.clearOptions();
    	 $.ajax({
		url:"searchRes",
		type:"POST",
		data: {search_item: "*"},
		dataType:"html",
		success: function(data){
			$("#reservationsPartial").empty().html(data);
		}
	});
    });

});