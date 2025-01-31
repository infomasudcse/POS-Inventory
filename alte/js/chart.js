

/*
     * BAR CHART
     * ---------
     */





$.ajax({         
  url: "/DashboardController/getChartData/week",
  cache: false          
  }).done(function( cdata ) {

    // $.plot($('#bar-week-chart'), data, options);

    var bar_data = {
      data : JSON.parse(cdata),
      bars: { show: true },
      valueLabels:
      {
         show: true,
         showTextLabel: true,
         yoffset: 1,
         align: 'center',
         font: "12pt 'Trebuchet MS'",
         fontcolor: 'blue'
      }
    }
   
     $.plot('#bar-week-chart', [bar_data], {
    grid  : {
      borderWidth: 0.5,
      borderColor: '#f3f3f3',
      tickColor  : '#f3f3f3'
    },
    series: {
       bars: {
        show: true, barWidth: 0.2, align: 'center'
      },
    },
    colors: ['#206830'],
       xaxis : {
         ticks: [[0,'Sun'], [1, 'Mon'], [2,'Tue'], [3,'Wed'], [4,'Thu'], [5,'Fri'], [6,'Sat']]
       },
    })




  }); 


  $.ajax({         
    url: "/DashboardController/getChartData/month",
    cache: false          
    }).done(function( cdata ) {
  
      var bar_data = {
        data : JSON.parse(cdata), //[[1,10], [2,8], [3,4], [4,13], [5,17], [6,9],[7,20],[8,10],[9,15],[10,25],[11,20],[12,15],[13,18],[14,19],[15,9]],
        bars: { show: true },
        valueLabels:
        {
           show: true,
           showTextLabel: true,
           yoffset: 1,
           align: 'center',
           font: "9pt 'Trebuchet MS'",
           fontcolor: 'blue'
        }
      }
      $.plot('#bar-chart', [bar_data], {
        grid  : {
          borderWidth: 0.5,
          borderColor: '#f3f3f3',
          tickColor  : '#f3f3f3'
        },
        series: {
           bars: {
            show: true, barWidth: 0.2, align: 'center',
          },
        },
        colors: ['#3c8dbc'],
        xaxis : {
          ticks: [[1,'1'], [2,'2'], [3,'3'], [4,'4'], [5,'5'], [6,'6'],[7,'7'],[8,'8'],[9,'9'],[10,'10'],[11,'11'],[12,'12'],[13,'13'],[14,'14'],[15,'15'],[16, '16'],[17, '17'],[18, '18'],[19, '19'],[20, '20'],[21, '21'],[22, '22'],[23, '23'],[24, '24'],[25,'25'],[26,'26'],[27,'27'][28,'28'],[29,'29'],[30,'30'],[31,'31']]
        }
      })
  
    }); 
    /* END BAR CHART */