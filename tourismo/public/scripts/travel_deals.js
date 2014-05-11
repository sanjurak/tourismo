$(document).ready(function(){
    var list = $(".trvlDealsDetails");
    for (i = 0, len = list.length; i < len; i++){
        list[i].onclick=function(){
            $.ajax({
                url: 'travelDealDetails',
                type: 'GET',
                dataType: 'json',
                data: {
                    trvlDls_id: $(this)[0].name
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    list = $(".modal-body input");
                    for (i = 0, len = list.length; i < len; i++){
                        list[i].removeAttribute("value");
                    }

                    if (res.data != null) {
                        var trvldl = jQuery.parseJSON(res.data);
                        $(".modal-body #id")[0].setAttribute("value", trvldl.id);
                        $(".modal-body #category")[0].setAttribute("value", trvldl.category);
                        $(".modal-body #destination")[0].setAttribute("value", trvldl.destination);
                        $(".modal-body #organizer")[0].setAttribute("value", trvldl.organizer);
                        $(".modal-body #accom_type")[0].setAttribute("value", trvldl.accom_type);
                        $(".modal-body #accom_name")[0].setAttribute("value", trvldl.accom_name);
                        if(trvldl.transportation != null){
                            $(".modal-body #transportation")[0].setAttribute("value", trvldl.transportation);
                        }
                        if(trvldl.service != null){
                            $(".modal-body #service")[0].setAttribute("value", trvldl.service);
                        }
                        $(".modal-body #price_din")[0].setAttribute("value", trvldl.price_din);
                        if(trvldl.price_eur != null)
                            $(".modal-body #price_eur")[0].setAttribute("value", trvldl.price_eur);
                        }
                    }
            });
        };
    }

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
            SearchTrvlDls(term, $("#dstCountryTownSelect")[0].value);
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

    $("#traveldealNew").hide();

    $("#addNewTrvlDeal").click(function(){
        if ($("#traveldealNew").is(":visible"))
            $("#traveldealNew").slideUp(); 
        else
            $("#traveldealNew").slideDown();        
    });

    $("#dstCountryTownSelect").click(function(){
        var selectize = $('#dstCountryTownSelect')[0].selectize;
        selectize.load();
    });

    $("#addNewTrvlDlsForm").validationEngine();

    $("#addNewTrvlDlsForm").submit(function(event){
            if($(this).validationEngine("validate"))
                return true;
            else
                return false;//event.preventDefault();
    });

    $( "#accordion" ).accordion({
      collapsible: true
    });
});