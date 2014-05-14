$(document).ready(function(){
	var list = $(".paymentDetails");
	for (i = 0, len = list.length; i < len; i++){
		list[i].onclick=function(){
			$.ajax({
                url: 'paymentDetails',
                type: 'GET',
                dataType: 'json',
                data: {
                    payment_id: $(this)[0].name
                },
                error: function() {
                     $(".modal-footer btn-cancel").click();
                    callback();
                },
                success: function(res) {
                    list = $(".modal-body input");
                    for (i = 0, len = list.length; i < len; i++){
                        list[i].removeAttribute("value");
                    }

                    if (res.data != null) {
                        var psg = jQuery.parseJSON(res.data);
                        if (psg.payment_type == "kartica")
                            $(".modal-body #paymenttype")[0].setAttribute(
                                "value", psg.payment_type + " (" + psg.card_type + ")");
                        else
                            $(".modal-body #paymenttype")[0].setAttribute("value", psg.payment_type);
                        $(".modal-body #passanger")[0].setAttribute("value", psg.passanger_name
                            + " " + psg.passanger_surname + ", JMBG: " + psg.passanger_jmbg);
                        $(".modal-body #reservationnum")[0].setAttribute("value", psg.reservation_number);
                        if(psg.date != null && psg.date.toString() != "1970-01-01"
                            && psg.date.toString() != "0000-00-00") {
                            var date = new Date(psg.date);
                            $(".modal-body #resdate")[0].setAttribute("value",
                                padStr(date.getFullYear()) + "-" +
                                padStr(1 + date.getMonth()) + "-" +
                                padStr(date.getDate()));
                        }
                        $(".modal-body #exchangerate")[0].setAttribute("value", psg.exchange_rate);
                        $(".modal-body #amountdin")[0].setAttribute("value", psg.amount_din);
                        $(".modal-body #amounteurdin")[0].setAttribute("value", psg.amount_eur_din);
                        $(".modal-body #paymentmethod")[0].setAttribute("value", psg.payment_method);
                        $(".modal-body #paymentdescription")[0].setAttribute("value", psg.description);
                        $(".modal-body #fiscalslip")[0].setAttribute("value", psg.fiscal_slip);
                        $(".modal-body #hidden_id")[0].setAttribute("value", psg.id);
                    };
                }
            });
		};
	}

    $('.input-append').click(function(event)
        {
            event.preventDefault();
        });


    $("#bresetPayment").click(function(){
        var selectize = $("#basicPaymentSearch")[0].selectize;
        selectize.clear();
        selectize.clearOptions();
        SearchPayments("*");        
    });

    $("#basicPaymentSearch").selectize({
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
            {value: 'reservation_number', label: 'Broj Rezervacije'},
            {value: 'jmbg', label: 'JMBG'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['reservation_number','jmbg'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'autocompletePayment',
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
            SearchPayments(term);
        }
    });

    $("#addNewPaymentForm").validationEngine();

    $("#addNewPaymentForm").submit(function(event){
            if($(this).validationEngine("validate"))
                return true;
            else
                return false;//event.preventDefault();
    });

    $("#printPayment").click(function(event){
        window.open('paymentSlip/' + $(".modal-body #hidden_id")[0].value);
    });
});

function padStr(i) {
    return (i < 10) ? "0" + i : "" + i;
}