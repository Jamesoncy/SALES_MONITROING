reload();
setInterval(function(){
    reload()}, 60000)
function reload(){
	$(".branch_table").each(function(){
		var branch = $(this).attr("branch"),
			date_selected = $("#date_selected").val(),
		url = baseUrl+"dashboard/get_branch_details/"+branch+"/"+date_selected,
		table = this;
		console.log(url);
		$.ajax({
	        url: url,
	        type: 'GET',
	        cache: false,
	        error: function(){
	            return true;
	        },
	        success: function(data){ 
	        	jQuery.each(data, function(i, val) {
					var tr = $(table).find("."+i);
					jQuery.each(val, function(index, values) {
						tr.find("."+index).html(values)
					});
				});
	        }
	    });

	});
}
