$( document ).ready(function() {
    
    $('#rResetPicture').click(function() {

    	$('#rAddPicture').val("");
    	$('#rResetPicture').toggleClass('invisible');

    });

    $('#rAddPicture').change(function(){
    	
    	$('#rResetPicture').toggleClass('invisible');

    });
});