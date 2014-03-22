$(document).ready(function(){

	$(".editableC").editable();
	$("#advancedSearch").hide();

	$("#advanced").click(function(){
		$("#advancedSearch").slideDown();
	});

	$("#breset").click(function(){
		$("#basic").val('');		
	});

	$("#basic").selectize({
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
            {value: 'town', label: 'Gradovi'},
            {value: 'country', label: 'Zemlje'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['country','town'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'autocompleteDST',
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
			url:"basicSearch",
			type:"POST",
			data: {search_item: term },
			dataType:"html",
			success: function(data){
				$("#list_view").empty().html(data);
			}
		});
        }
    });

});