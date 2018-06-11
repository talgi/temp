$(document).ready(function(){

	$("#analytics-form").submit(function(e){

		e.preventDefault();
		var url = window.location.href;
		var params = $(this).serialize();
		var xhr = $.ajax({
			url:url,
			type:"post",
			data:params
		})
		xhr.done(function(res){
			alertify.success("All right You just saved your staff")
		})
		xhr.fail(function( jqXHR, textStatus, errorThrown ) {
			alertify.error("Somthing went wrong please try agian");
			
		  });

	});


});