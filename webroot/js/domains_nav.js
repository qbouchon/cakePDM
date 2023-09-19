
$( document ).ready(function(){

	displayDomainsNav();

});
	


function displayDomainsNav(){

	var url = webrootUrl+"domains/";

			$.get(url,function(domains){


				console.log(domains);
				domains.forEach(function(domain,index){
					
					console.log(index);
					var marginTop = index >= domains.length / 2 ? -1 * index : -1* (domains.length - index - 1);

					$('#domainsNav').append("<div class='para-container' style='margin-top: " + marginTop + "px'><img class='' src="+webrootUrl+'img/domains/'+ encodeURIComponent(domain.picture_path)+"></img></div>");
				});
			});

}
