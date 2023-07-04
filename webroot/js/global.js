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
    inputCount = 1;
    $('#addFileInput').click(function() {

        appendContent =     '<div class="d-flex align-items-center">'
                            +'<div class="">'
                            +'<label class="form-label" for"File'+inputCount+'">Importer un fichier (image, pdf, document office, openoffice, libreoffice)</label>'
                            +'<input id="File'+inputCount+'" class="form-control mb-3 iFile" type="file" name="files[]" accept="*">'
                            +'</div>'                   
                            +'<div id="rFile'+inputCount+'" class="rResetFile invisible" data-toggle="File'+inputCount+'"><button class="btn fa-solid fa-xmark fa-xl" data-toggle="tooltip" data-placement="top" title="Supprimer"> </button></div>'
                            +'</div>';
        $('#inputFileDiv').append(appendContent);
        inputCount++;
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

    //init reset button visibility pour le premier input file
    if($('#iFile').val())
        $('#rFile').removeClass('invisible');


    $(document).on('click','.rResetFile', function() {

        idInput = '#'+$(this).attr('data-toggle');
        $(idInput).val("");
        $(this).addClass("invisible");

    });

    $(document).on('change','.iFile', function() {

        idInput = $(this).attr('id');
        idResetFile = '#r'+idInput

        //alert('idInput    '+idInput+'   idResetFile   ' + idResetFile + ' val '+$(this).val());

        if($(this).val())
        {
            $(idResetFile).removeClass("invisible");
        }
        else
        {
            $(idResetFile).addClass("invisible");
        }


    });





});
