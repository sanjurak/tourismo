$(document).ready(function(){


    $("#loginForm").validationEngine();

    $("#loginForm").submit(function(event){
            if($(this).validationEngine("validate"))
                return true;
            else
                return false;
        });


    $("[rel='tooltip']").popover();

	$(".editableC").editable();

    $("#addDstModal").hide();
    
	$("#advanced").click(function(){
		$("#advancedSearch").slideToggle();
	});

	$("#advancedSearchForm").submit(function(event){
		event.preventDefault();
		AdvancedSearch($(this), "advancedSearch");
	});

    $("#advancedSearchFormOrg").submit(function(event){
        event.preventDefault();
        AdvancedSearch($(this), "advancedSearchOrg");
    });

	$("#breset").click(function(){
		var selectize = $("#basic")[0].selectize;
		selectize.clear();
		selectize.clearOptions();;
		Search("*","basicSearch");		
	});

    $("#bresetOrg").click(function(){
        var selectize = $("#basicOrg")[0].selectize;
        selectize.clear();
        selectize.clearOptions();
        Search("*","basicSearchOrg");      
    });

	$("#basic").selectize({
        valueField: 'term',
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
			Search(term, "basicSearch");
        }
    });

$("#basicOrg").selectize({
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
            {value: 'names', label: 'Naziv'},
            {value: 'email', label: 'EMail'},
            {value: 'address', label: 'Adresa'},
            {value: 'web', label: 'Web sajt'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['name','email','address','web'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'autocompleteORG',
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
            //Search(query,"basicSearchOrg");
        },
        onChange: function(){
            var term = this.items[0];
            Search(term,"basicSearchOrg");
        }
    });

    $("#addNewDstForm").validationEngine();


    $("#addNewDstForm").submit(function(event){
		  event.preventDefault();
            var valid = $(this).validationEngine("validate");
            if(valid)
		      NewDestination($(this));
    });

    $("#addNewDstForm").validationEngine();

    $("#addNewDst").click(function(){
        $("#addNewDstForm").trigger('submit');
    });

    $("#addNewDstForm").submit(function(event){
            event.preventDefault();
            if($(this).validate())
              NewDestination($(this));
        });
    
    $("#addNewDst").click(function(){
        $("#addNewDstForm").trigger('submit');
    });


});
