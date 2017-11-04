(function($){

	$(document).ready(function(){

		$("input[type=file]").change(function(){
	        $(".icone").html($(this).val());
	        $(".icone").removeClass('bg-warning');
	        $(".icone").addClass('bg-success');
	        $(".icone").removeClass('pointer');
	        $(".icone").click(function(){
	        	return false;
	        });
	    });

	});

})(jQuery);