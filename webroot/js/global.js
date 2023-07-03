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

        appendContent =     '<div class="d-flex align-items-center">'
                            +'<div class="">'
                            +'<label class="form-label" for"file">Importer un fichier (image, pdf, document office, openoffice, libreoffice)</label>'
                            +'<input id="file" class="form-control mb-3" type="file" name="files[]" accept="*">'
                            +'</div>'                   
                            +'<div class="rResetFile" data-toggle="file1"><button class="btn fa-solid fa-xmark fa-xl" data-toggle="tooltip" data-placement="top" title="Supprimer"> </button></div>'
                            +'</div>';
        $('#inputFileDiv').append(appendContent);
    });



    $('#rDeletePicture').click(function() {

       $('#deleteFileToggler').prop('checked',true);
       $('#cancelDeleteFile').html('<i>Le fichier sera supprimé à la validation du formulaire</i> <a href="#" class="link-danger d-inline">Annuler</a>');
       $('#cancelDeleteFile').toggleClass('invisible');
       $('#PictureManagement').toggleClass('invisible');

    });


    $('#cancelDeleteFile').click(function() {

       $('#deleteFileToggler').prop('checked',false);
       $('#cancelDeleteFile').html("");
       $('#cancelDeleteFile').toggleClass('invisible');
       $('#PictureManagement').toggleClass('invisible');

    });



    //Gestion des boutons de reset de fichier uploadé





});
