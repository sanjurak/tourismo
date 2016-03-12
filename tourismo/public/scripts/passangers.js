$(document).ready(function(){
	var list = $(".passangerDetails");
	for (i = 0, len = list.length; i < len; i++){
		list[i].onclick=function(){
			$.ajax({
                url: 'passangerDetails',
                type: 'GET',
                dataType: 'json',
                data: {
                    psg_id: $(this)[0].name
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    list = $(".modal-body input");
                    for (i = 0, len = list.length; i < len; i++){
                        list[i].removeAttribute("value");
                    }
                    $(".modal-body #gender")[0].value = "";

                    if (res.data != null) {
                        var psg = jQuery.parseJSON(res.data);
                        $(".modal-body #id")[0].setAttribute("value", psg.id);
                        $(".modal-body #name")[0].setAttribute("value", psg.name);
                        $(".modal-body #surname")[0].setAttribute("value", psg.surname);
                        $(".modal-body #address")[0].setAttribute("value", psg.address);
                        $(".modal-body #jmbg")[0].setAttribute("value", psg.jmbg);
                        if(psg.gender != null){
                            $(".modal-body #gender")[0].value = psg.gender;
                        }
                        if(psg.tel != null){
                            $(".modal-body #tel")[0].setAttribute("value", psg.tel);
                        }
                        if(psg.mob != null){
                            $(".modal-body #mob")[0].setAttribute("value", psg.mob);
                        }
                        if(psg.passport != null){
                            $(".modal-body #passport")[0].setAttribute("value", psg.passport);
                        }
                        if(psg.birth_date != null && psg.birth_date.toString() != "1970-01-01"
                            && psg.birth_date.toString() != "0000-00-00") {
                            var date = new Date(psg.birth_date);
    	                    $(".modal-body #birth_date").val(date.format("d-m-yyyy"));
    	            	}
                        if(psg.email != null){
                            $(".modal-body #email")[0].setAttribute("value", psg.email);
                        }
                    };
                }
            });
		};
	}

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

    $("#gender").change(function () {
        if($(this).val() == null) $(this).addClass("empty");
        else $(this).removeClass("empty");
    });
    $("#gender").change();

   // $('.input-append').click(function(event)
   //     {
   //         event.preventDefault();
   //     });

  //  $('#birth_datepicker input').click(function(event){
  //          event.preventDefault();
  //      });

	$('#birth_date').datepicker();
	$('#birth_date').datepicker( "option", "dateFormat", 'd-m-yy' );

  //  $('#birth_datepicker span').click(function(){
  //     birthdatepicker.datepicker('show');
  //  });


//	$("#psgDetailModal").dialog({
//		autoOpen: false
//	});

//	$("#addNewPsg").click(function () {
//		$("#psgDetailModal").dialog('open');
//	});
});


function padStr(i) {
    return (i < 10) ? "0" + i : "" + i;
}

function SearchPsg(term)
{
    $.ajax({
            url:"basicPsgSearch",
            type:"POST",
            data: {search_item: term },
            dataType:"html",
            success: function(data){
                $("#passangersData").empty().html(data);
            }
        });
}
