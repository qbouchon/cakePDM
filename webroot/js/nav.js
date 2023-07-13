window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');

    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        //if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
         //  document.body.classList.toggle('sb-sidenav-toggled');
         //}
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // //mouseOver on nav-item
    // document.querySelectorAll('.collapseOver').forEach(function(item){

    //     item.addEventListener('mouseenter', function(e){


    //         let id_target = this.querySelector('.nav-link').getAttribute('data-bs-target');
    //         let target = document.querySelector(id_target);
    //         if(target != null){
    //              //console.log(id_target + "Collapsing" +  target.classList.contains('collapsing'))
    //              console.log(id_target + "show" + target.classList.contains('show'))
    //             if(!target.classList.contains('collapsing') && !target.classList.contains('show'))
    //             {
    //                //target.setAttribute('class','collaping');
    //                new bootstrap.Collapse(target); 
    //             }
             

    //         }
    //     })

    //     item.addEventListener('mouseleave', function(e){

    //         let id_target = this.querySelector('.nav-link').getAttribute('data-bs-target');
    //         let target = document.querySelector(id_target);
    //         if(target != null){
    //             // if(!target.classList.contains('collapsing') && target.classList.contains('show'))
    //             // {
    //                 target.setAttribute('class','collapse');
    //                 //new bootstrap.Collapse(target);

    //             //}

    //         }
    //     })

    // });

    

});


//Pour garder la même config du menu au rechargement d'une page
$(document).ready(function () {

    $(".collapse").on("shown.bs.collapse", function () {
        localStorage.setItem("coll_" + this.id, true);
    });

    $(".collapse").on("hidden.bs.collapse", function () {
        localStorage.removeItem("coll_" + this.id);
    });
    
    $(".collapse").each(function () {
        if (localStorage.getItem("coll_" + this.id) === "true") {
            $(this).toggleClass('no-transition');
            $(this).collapse('show');
            $(this).toggleClass('no-transition');
        }
        // else {
        //     $(this).collapse("hide");
        // }

    });
});
