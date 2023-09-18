$( document ).ready(function() {
    
    //init TinyMCE (Editeur de texte)
    tinymce.init({selector: 'textarea', promotion: false});


    //init reset button visibility
    if($('#rAddPicture').val())
        $('#rResetPicture').removeClass('invisible');

    //Gestion d'un boutton pour supprimer l'mage ajouté
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
            $('#cancelDeletePicture').addClass('invisible');
        }

    });

    //Gestion d'un boutton pour ajouter un input file pour l'upload de plusieurs fichiers (Resources)
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


    //Gestion de la supp d'image dans edit resource et edit domain
    $('#rDeletePicture').click(function() {

       $('#deletePictureToggler').prop('checked',true);
       $('#cancelDeletePicture').html('<i>Le fichier sera supprimé à la validation du formulaire</i> <a href="#" class="link-danger d-inline">Annuler</a>');
       $('#cancelDeletePicture').toggleClass('invisible');
       $('#PictureManagement').toggleClass('invisible');

    });


    $('#cancelDeletePicture').click(function(e) {

        e.preventDefault()
        $('#deletePictureToggler').prop('checked',false);
        $('#cancelDeletePicture').html("");
        $('#cancelDeletePicture').toggleClass('invisible');
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

        
        if($(this).val())
        {
            $(idResetFile).removeClass("invisible");
        }
        else
        {
            $(idResetFile).addClass("invisible");
        }


    });

    //Gestion de la supp de files dans edit resource
    $(document).on('click','.rDeleteFile', function() {

       rId = $(this).attr('data-toggle');
       cancelDeleteFileId = '#cancelDeleteFile'+rId;
       FileManagementId = '#FileManagement'+rId;
       deleteFileTogglerId = '#deleteFileToggler'+rId;

       $(deleteFileTogglerId).prop('disabled',false);
       $(cancelDeleteFileId).html('<i>Le fichier sera supprimé à la validation du formulaire</i> <a href="#" class="link-danger d-inline">Annuler</a>');
       $(cancelDeleteFileId).toggleClass('invisible');
       $(FileManagementId).toggleClass('invisible');

    });

    $(document).on('click','.cancelDeleteFile', function(e) {

        e.preventDefault()
        rId = $(this).attr('data-toggle');
        cancelDeleteFileId = '#cancelDeleteFile'+rId;
        FileManagementId = '#FileManagement'+rId;
        deleteFileTogglerId = '#deleteFileToggler'+rId;

        $(deleteFileTogglerId).prop('disabled',true);
        $(cancelDeleteFileId).html("");
        $(cancelDeleteFileId).toggleClass('invisible');
        $(FileManagementId).toggleClass('invisible');

    });

   
    //------------------------------------------------------------------ Tooltips -----------------------------------------------------------------------------------



   tippy('.unbackResa', {
                                        content: 'Cette ressource n\'a pas été retournée.',
                                        duration: 0,
                                        allowHTML:true,
                                        followCursor: 'initial',
                                        

    }); 

    tippy('.unbackResaUser', {
                                        content: 'Ressource à retourner au CREST. Merci de contacter un administrateur si vous l\'avez déjà fait.',
                                        duration: 0,
                                        allowHTML:true,
                                        followCursor: 'initial',
                                        

    }); 

      tippy('.isBack', {
                                        content: 'Cette ressource à été rendue.',
                                        duration: 0,
                                        allowHTML:true,
                                        followCursor: 'initial',
                                        

    }); 

     tippy('.calendarViewButton', {
                                        content: 'Passer en vue calendrier',
                                        duration: 0,
                                        allowHTML:true,
                                      
                                        

    }); 

    tippy('.listViewButton', {
                                        content: 'Passer en vue liste',
                                        duration: 0,
                                        allowHTML:true,
                                      
                                        

    }); 

    tippy('.reservationAddButton', {
                                        content: 'Créer une nouvelle réservation',
                                        duration: 0,
                                        allowHTML:true,
                                      
                                        

    }); 

    tippy('.resourceAddButton', {
                                        content: 'Créer une nouvelle ressource',
                                        duration: 0,
                                        allowHTML:true,
                                      
                                        

    }); 

    tippy('.domainAddButton', {
                                        content: 'Créer un nouveau domaine',
                                        duration: 0,
                                        allowHTML:true,
                                      
                                        

    }); 

    tippy('.closingDatesAddButton', {
                                        content: 'Créer une nouvelle plage de dates de fermeture',
                                        duration: 0,
                                        allowHTML:true,
                                      
                                        

    }); 

    tippy('.userAddButton', {
                                        content: 'Créer un nouvel utilisateur',
                                        duration: 0,
                                        allowHTML:true,
                                      
                                        

    }); 



    tippy('.viewbackButton', {
                                        content: 'Afficher les réservations retournées',
                                        duration: 0,
                                        allowHTML:true,
                                      
                                        

    }); 
    tippy('.hidebackButton', {
                                        content: 'Cacher les réservations retournées',
                                        duration: 0,
                                        allowHTML:true,
                                      
                                        

    }); 
     

});
