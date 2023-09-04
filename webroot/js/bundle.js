/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./webroot/js/app.js":
/*!***************************!*\
  !*** ./webroot/js/app.js ***!
  \***************************/
/***/ (() => {

eval("$( document ).ready(function() {\n    \n    //init TinyMCE (Editeur de texte)\n    tinymce.init({selector: 'textarea', promotion: false});\n\n\n    //init reset button visibility\n    if($('#rAddPicture').val())\n        $('#rResetPicture').removeClass('invisible');\n\n    //Gestion d'un boutton pour supprimer l'mage ajouté\n    $('#rResetPicture').click(function() {\n\n    \t$('#rAddPicture').val(\"\");\n    \t$('#rResetPicture').addClass('invisible');\n        $('#PictureManagementBlock').removeClass('invisible');\n\n    });\n\n    $('#rAddPicture').change(function(){\n\n        if($('#rAddPicture').val())\n        {\n            $('#rResetPicture').removeClass('invisible');\n            $('#PictureManagementBlock').addClass('invisible');\n        }\n        else\n        {\n    \t    $('#rResetPicture').addClass('invisible');\n            $('#cancelDeletePicture').addClass('invisible');\n        }\n\n    });\n\n    //Gestion d'un boutton pour ajouter un input file pour l'upload de plusieurs fichiers (Resources)\n    inputCount = 1;\n    $('#addFileInput').click(function() {\n\n        appendContent =     '<div class=\"d-flex align-items-center\">'\n                            +'<div class=\"\">'\n                            +'<label class=\"form-label\" for\"File'+inputCount+'\">Importer un fichier (image, pdf, document office, openoffice, libreoffice)</label>'\n                            +'<input id=\"File'+inputCount+'\" class=\"form-control mb-3 iFile\" type=\"file\" name=\"files[]\" accept=\"*\">'\n                            +'</div>'                   \n                            +'<div id=\"rFile'+inputCount+'\" class=\"rResetFile invisible\" data-toggle=\"File'+inputCount+'\"><button class=\"btn fa-solid fa-xmark fa-xl\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Supprimer\"> </button></div>'\n                            +'</div>';\n        $('#inputFileDiv').append(appendContent);\n        inputCount++;\n    });\n\n\n    //Gestion de la supp d'image dans edit resource et edit domain\n    $('#rDeletePicture').click(function() {\n\n       $('#deletePictureToggler').prop('checked',true);\n       $('#cancelDeletePicture').html('<i>Le fichier sera supprimé à la validation du formulaire</i> <a href=\"#\" class=\"link-danger d-inline\">Annuler</a>');\n       $('#cancelDeletePicture').toggleClass('invisible');\n       $('#PictureManagement').toggleClass('invisible');\n\n    });\n\n\n    $('#cancelDeletePicture').click(function(e) {\n\n        e.preventDefault()\n        $('#deletePictureToggler').prop('checked',false);\n        $('#cancelDeletePicture').html(\"\");\n        $('#cancelDeletePicture').toggleClass('invisible');\n        $('#PictureManagement').toggleClass('invisible');\n\n    });\n\n\n\n    //Gestion des boutons de reset de fichier uploadé\n\n    //init reset button visibility pour le premier input file\n    if($('#iFile').val())\n        $('#rFile').removeClass('invisible');\n\n\n    $(document).on('click','.rResetFile', function() {\n\n        idInput = '#'+$(this).attr('data-toggle');\n        $(idInput).val(\"\");\n        $(this).addClass(\"invisible\");\n\n    });\n\n    $(document).on('change','.iFile', function() {\n\n        idInput = $(this).attr('id');\n        idResetFile = '#r'+idInput\n\n        \n        if($(this).val())\n        {\n            $(idResetFile).removeClass(\"invisible\");\n        }\n        else\n        {\n            $(idResetFile).addClass(\"invisible\");\n        }\n\n\n    });\n\n    //Gestion de la supp de files dans edit resource\n    $(document).on('click','.rDeleteFile', function() {\n\n       rId = $(this).attr('data-toggle');\n       cancelDeleteFileId = '#cancelDeleteFile'+rId;\n       FileManagementId = '#FileManagement'+rId;\n       deleteFileTogglerId = '#deleteFileToggler'+rId;\n\n       $(deleteFileTogglerId).prop('disabled',false);\n       $(cancelDeleteFileId).html('<i>Le fichier sera supprimé à la validation du formulaire</i> <a href=\"#\" class=\"link-danger d-inline\">Annuler</a>');\n       $(cancelDeleteFileId).toggleClass('invisible');\n       $(FileManagementId).toggleClass('invisible');\n\n    });\n\n    $(document).on('click','.cancelDeleteFile', function(e) {\n\n        e.preventDefault()\n        rId = $(this).attr('data-toggle');\n        cancelDeleteFileId = '#cancelDeleteFile'+rId;\n        FileManagementId = '#FileManagement'+rId;\n        deleteFileTogglerId = '#deleteFileToggler'+rId;\n\n        $(deleteFileTogglerId).prop('disabled',true);\n        $(cancelDeleteFileId).html(\"\");\n        $(cancelDeleteFileId).toggleClass('invisible');\n        $(FileManagementId).toggleClass('invisible');\n\n    });\n\n    \n\n\n\n});\n\n\n//# sourceURL=webpack:///./webroot/js/app.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./webroot/js/app.js"]();
/******/ 	
/******/ })()
;