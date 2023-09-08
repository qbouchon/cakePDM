var  resourcesChart;

 $(document).ready(function() {

        createResourcesChart();

        $("#start").on('change',function(){
          resourcesChart.destroy();
          createResourcesChart();
        });


        $("#end").on('change',function(){
          resourcesChart.destroy();
          createResourcesChart();
        });
    

});





function createResourcesChart(){


    var start = $('#start').val();
    var end = $('#end').val();

    if(!start)
      start = 0;
    if(!end)
      end= 0;

    var url = webrootUrl + 'reservations/stats/reservations_count/'+start+'/'+end;

    $.get(url, function(datas){

        displayChart(datas);


    });

}










function displayChart(datas)
{
      const ctx = document.getElementById('myChart');

      resourcesChart = new Chart(ctx, {
        type: 'bar',
        data: datas,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
}

