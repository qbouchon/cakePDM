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
        $('#inputFileDiv').append('<input id="file" class="form-control mb-3" type="file" name="files[]" accept="*">');
    });



    $('#rDeletePicture').click(function() {

      // $('#deleteFileToggler').attr('checked',true);
         $('#deleteFileToggler').prop('checked',true);
      // $('#deleteFileToggler').val(true);
       $('#cancelDeleteFile').html('<i>Le fichier sera supprimé à la validation du formulaire</i> <a href="#" class="link-danger d-inline">Annuler</a>');
       $('#cancelDeleteFile').toggleClass('invisible');
       $('#PictureManagement').toggleClass('invisible');
    });


    $('#cancelDeleteFile').click(function() {


      // $('#deleteFileToggler').attr('checked',false);
        $('#deleteFileToggler').prop('checked',false);
      // $('#deleteFileToggler').val(false);
       $('#cancelDeleteFile').html("");
       $('#cancelDeleteFile').toggleClass('invisible');
       $('#PictureManagement').toggleClass('invisible');


    });


});
