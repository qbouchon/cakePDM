$( document ).ready(function() {
    
    //init reset button visibility
    if($('#rAddPicture').val())
        $('#rResetPicture').removeClass('invisible');

    //Gestion d'un boutton pour supprimer le fichier ajouté
    $('#rResetPicture').click(function() {

    	$('#rAddPicture').val("");
    	$('#rResetPicture').addClass('invisible');
        $('#PictureManagementBlock').removeClass('invisible');

    });

    $('#rAddPicture').change(function(){

        if($('#rAddPicture').val())
        {
            $('#rResetPicture').removeClass('invisible');
            $('#PictureManagementBlock').addClass('invisible');
        }
        else
        {
    	    $('#rResetPicture').addClass('invisible');
            $('#cancelDeleteFile').addClass('invisible');
        }

    });

    //Gestion d'un boutton pour ajouter un input file pour l'upload de plusieurs fichiers (resources)
    $('#addFileInput').click(function() {
        $('#inputFileDiv').append('<input id="file" class="form-control" type="file" name="file[]"" accept="*">');
    });



    $('#rDeletePicture').click(function() {

       $('#deleteFileToggle').attr('checked',true);
       $('#cancelDeleteFile').html('<i>fichier supprimé</i> <a href="#" class="link-danger d-inline">Annuler</a>');
       $('#cancelDeleteFile').toggleClass('invisible');
       $('#PictureManagement').toggleClass('invisible');
    });


    $('#cancelDeleteFile').click(function() {


       $('#deleteFileToggle').attr('checked',false);
       $('#cancelDeleteFile').html("");
       $('#cancelDeleteFile').toggleClass('invisible');
       $('#PictureManagement').toggleClass('invisible');


    });


});
