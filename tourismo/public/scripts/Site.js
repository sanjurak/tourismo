$(document).ready(function(){

	$(".editableC").editable();
	$("#advancedSearch").hide();

	$("#advanced").click(function(){
		$("#advancedSearch").slideDown();
	});

	$("#advancedSearchForm").submit(function(event){
		event.preventDefault();
		AdvancedSearch($(this));
	})

	$("#breset").click(function(){
		var selectize = $("#basic")[0].selectize;
		selectize.clear();
		selectize.clearOptions();
		Search("*");		
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
			Search(term);
        }
    });

$("#addNewDst").click(function(){
	$("#addNewDstForm").trigger('submit');
});

$("#addNewDstForm").submit(function(event){
		event.preventDefault();
		NewDestination($(this));
	});
});
