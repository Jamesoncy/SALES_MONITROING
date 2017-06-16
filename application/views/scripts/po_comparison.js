 		var date_selected = $("#date_selected").val(),
		url = baseUrl+"dashboard/product_comparison/" + date_selected;
                //alert(date_selected);
		$.ajax({
	        url: url,
	        type: 'GET',
	       
	        error: function(){
	            return true;
	        },
	        success: function(data){ 
	        	$("#generating").hide();	
	        }
	    });


              reload();
setInterval(function(){
    reload()}, 5000);
function reload(){
                var url = baseUrl+"dashboard/create_table_comparison";
                console.log(url);
                $.ajax({
                url: url,
                type: 'GET',
                cache: false,
                error: function(){
                    return true;
                },
                success: function(data){
                        alert(data);
                }
            });
}

