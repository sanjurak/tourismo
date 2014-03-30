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
	                    $(".modal-body #birth_date")[0].setAttribute("value",
	                    	padStr(date.getFullYear()) + "-" +
	                  		padStr(1 + date.getMonth()) + "-" +
	                  		padStr(date.getDate()));
	            	}
                }
            });
		};
	}
});

function padStr(i) {
    return (i < 10) ? "0" + i : "" + i;
}