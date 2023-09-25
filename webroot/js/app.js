$( document ).ready(function() {
    
    //init TinyMCE (Editeur de texte)
    tinymce.init({selector: 'textarea', promotion: false});
    

    // -------------------------------------- Gestion des bouttons pour l'upload/supp d'images et de fichiers  ----------------------------------------------------
    //init reset button visibility
    if($('#rAddPicture').val())
        $('#rResetPicture').removeClass('displaynone');

    //Gestion d'un boutton pour supprimer l'mage ajouté
    $('#rResetPicture').click(function() {

    	$('#rAddPicture').val("");
    	$('#rResetPicture').addClass('displaynone');
        $('#PictureManagementBlock').removeClass('displaynone');

    });

    $('#rAddPicture').change(function(){

        if($('#rAddPicture').val())
        {
            $('#rResetPicture').removeClass('displaynone');
            $('#PictureManagementBlock').addClass('displaynone');
        }
        else
        {
    	    $('#rResetPicture').addClass('displaynone');
            $('#cancelDeletePicture').addClass('displaynone');
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
                            +'<div id="rFile'+inputCount+'" class="rResetFile displaynone" data-toggle="File'+inputCount+'"><button class="btn deleteFileButton fa-solid fa-xmark fa-xl"></button></div>'
                            +'</div>';
        $('#inputFileDiv').append(appendContent);

        //Création du tooltip
        tippy('#rFile'+inputCount, {
                                        content: 'Supprimer le fichier',
                                        duration: 0,
                                        allowHTML:true,                                                                           
        });

        inputCount++;
    });


    //Gestion de la supp d'image dans edit resource et edit domain
    $('#rDeletePicture').click(function() {

       $('#deletePictureToggler').prop('checked',true);
       $('#cancelDeletePicture').html('<i>Le fichier sera supprimé à la validation du formulaire</i> <a href="#" class="link-danger">Annuler</a>');
       $('#cancelDeletePicture').toggleClass('displaynone');
       $('#PictureManagement').toggleClass('displaynone');

    });


    $('#cancelDeletePicture').click(function(e) {

        e.preventDefault()
        $('#deletePictureToggler').prop('checked',false);
        $('#cancelDeletePicture').html("");
        $('#cancelDeletePicture').toggleClass('displaynone');
        $('#PictureManagement').toggleClass('displaynone');

    });



    //Gestion des boutons de reset de fichier uploadé

    //init reset button visibility pour le premier input file
    if($('#iFile').val())
        $('#rFile').removeClass('displaynone');


    $(document).on('click','.rResetFile', function() {

        idInput = '#'+$(this).attr('data-toggle');
        $(idInput).val("");
        $(this).addClass("displaynone");

    });

    $(document).on('change','.iFile', function() {

        idInput = $(this).attr('id');
        idResetFile = '#r'+idInput

        
        if($(this).val())
        {
            $(idResetFile).removeClass("displaynone");
        }
        else
        {
            $(idResetFile).addClass("displaynone");
        }


    });

    //Gestion de la supp de files dans edit resource
    $(document).on('click','.rDeleteFile', function() {

       rId = $(this).attr('data-toggle');
       cancelDeleteFileId = '#cancelDeleteFile'+rId;
       FileManagementId = '#FileManagement'+rId;
       deleteFileTogglerId = '#deleteFileToggler'+rId;

       $(deleteFileTogglerId).prop('disabled',false);
       $(cancelDeleteFileId).html('<i>Le fichier sera supprimé à la validation du formulaire</i> <a href="#" class="link-danger">Annuler</a>');
       $(cancelDeleteFileId).toggleClass('displaynone');
       $(FileManagementId).toggleClass('displaynone');

    });

    $(document).on('click','.cancelDeleteFile', function(e) {

        e.preventDefault()
        rId = $(this).attr('data-toggle');
        cancelDeleteFileId = '#cancelDeleteFile'+rId;
        FileManagementId = '#FileManagement'+rId;
        deleteFileTogglerId = '#deleteFileToggler'+rId;

        $(deleteFileTogglerId).prop('disabled',true);
        $(cancelDeleteFileId).html("");
        $(cancelDeleteFileId).toggleClass('displaynone');
        $(FileManagementId).toggleClass('displaynone');

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

    tippy('.addFileButton', {
                                        content: 'Ajouter un fichier',
                                        duration: 0,
                                        allowHTML:true,
                               
    });
   
     
    tippy('.deleteFileButton', {
                                        content: 'Supprimer le fichier',
                                        duration: 0,
                                        allowHTML:true,
                               
    });

   
    tippy('.deletePictureButton', {
                                        content: 'Supprimer l\'image',
                                        duration: 0,
                                        allowHTML:true,                                    
    });



    var helpMailButtonContent =  '<i>'
                    + 'Variables disponibles'
                    + '<br/>'
                    + '<b>$firstname :</b> prénom de l\'utilisateur'
                    + '<br/>'
                    + '<b>$lastname :</b> nom de l\'utilisateur'
                    + '<br/>'
                    + '<b>$login :</b> login de l\'utilisateur'
                    + '<br/>'
                    + '<b>$resource :</b> nom de la ressource'
                    + '<br/>'
                    + '<b>$start :</b> Date de début de réservation'
                    + '<br/>'
                    + '<b>$end :</b> Date de fin de réservation'
                    + '<br/>'
                    + '<i>'
    tippy('.helpMailButton', {
                                        content: helpMailButtonContent,
                                        duration: 0,
                                        allowHTML:true,
                                        trigger: 'click',
                           
    });


});
