$(document).ready(function(){
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