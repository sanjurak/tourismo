$(document).ready(function(){

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

	$("#bresetDst").click(function(){
		var selectize = $("#basicDstSearch")[0].selectize;
		selectize.clear();
		selectize.clearOptions();
		Search("*","basicSearch");		
	});

    $("#bresetOrg").click(function(){
        var selectize = $("#basicOrg")[0].selectize;
        selectize.clear();
        selectize.clearOptions();
        Search("*","basicSearchOrg");      
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

    $("#bresetPsg").click(function(){
        var selectize = $("#basicPsgSearch")[0].selectize;
        selectize.clear();
        selectize.clearOptions();
        SearchPsg("*");        
    });

    $("#basicPsgSearch").selectize({
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
            {value: 'name_surname_address', label: 'Ime Prezime Adresa'},
            {value: 'name_surname', label: 'Ime Prezime'},
            {value: 'name', label: 'Ime'},
            {value: 'surname', label: 'Prezime'},
            {value: 'address', label: 'Adresa'},
            {value: 'jmbg', label: 'jmbg'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['jmbg','name_surname_address','name_surname','name','surname','address'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'autocompletePSG',
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
            SearchPsg(term);
        }
    });

    $("#addNewPsgForm").validationEngine();

    $("#addNewPsgForm").submit(function(event){
            if($(this).validate())
                return true;
            else
                return false;//event.preventDefault();
        });

    $("#addNewFullPsgForm").validationEngine();

    $("#addNewFullPsgForm").submit(function(event){
            if($(this).validationEngine("validate"))
                return true;
            else
                return false;//event.preventDefault();
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

    $('.input-append').click(function(event)
        {
            event.preventDefault();
        });

    $('#birth_datepicker input').click(function(event){
            event.preventDefault();
        });

    $('#birth_datepicker input').datepicker({
        format: "yyyy/mm/dd",
        viewMode: 2,
        autoclose: true
    });

    $('#birth_datepicker span').click(function(){
       $('#birth_datepicker input').datepicker('show');
    });

$("#addNewDst").click(function(){
    $("#addNewDstForm").trigger('submit');
});

});



