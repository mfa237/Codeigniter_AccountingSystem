$(function() {

    var sparker = function() {

        // Inline Charts examples

        $(".linecharts").sparkline('html', { lineWidth: 2 });
        $(".barcharts").sparkline('html', {type: 'bar', barColor: '#009688'});

        // Composite line charts, the second using values supplied via javascript
        $('#compositeline').sparkline('html', { fillColor: false, lineWidth: 2, lineColor: '#2196f3', changeRangeMin: 0, chartRangeMax: 10 });
        $('#compositeline').sparkline([4,1,5,7,9,9,8,7,6,6,4,7,8,4,3,2,2,5,6,7], {composite: true, fillColor: false, lineColor: '#ff5722', lineWidth: 2, changeRangeMin: 0, chartRangeMax: 10 });


        // Bar + line composite charts
        $('#compositebar').sparkline('html', { type: 'bar', barColor: '#b0bec5' });
        $('#compositebar').sparkline([4,1,5,7,9,9,8,7,6,6,4,7,8,4,3,2,2,5,6,7], {composite: true, fillColor: false, lineColor: '#03a9f4', lineWidth: 2 });


        // Discrete charts
        $('#discrete1').sparkline('html', { type: 'discrete', lineColor: '#00bcd4', xwidth: 18 });
        $('#discrete2').sparkline('html', { type: 'discrete', lineColor: '#00bcd4', thresholdColor: '#ff5722', thresholdValue: 4 });

        $("#pie").sparkline([1,2,3], {type: 'pie'});

        // Large Charts

        $("#bigline").sparkline([15,14,14,17,16,19,15,18,12,16,14,16,17,14,12,11,15,17,12,11,14,12,10,13,16,13], {
            type: 'line',
            width: '100%',
            height: '200px',
            lineWidth: 2,
            lineColor: '#b0bec5',
            fillColor: '#eceff1',
            highlightSpotColor: '#b0bec5',
            highlightLineColor: '#b0bec5',
            chartRangeMin: 0,chartRangeMax: 20,
            spotRadius: 4});
        $("#bigline").sparkline([4,3,0,6,6,8,5,9,3,8,7,8,7,6,6,4,5,6,3,3,4,3,3,5,5,6], {
            type: 'line',
            width: '100%',
            height: '200px',
            lineWidth: 2,
            lineColor: '#546e7a',
            fillColor: '#b0bec5',
            highlightSpotColor: '#546e7a',
            highlightLineColor: '#546e7a',
            chartRangeMin: 0,
            chartRangeMax: 20,
            composite: true,
            spotRadius: 4});


        $("#bigpie").sparkline([5,3,4,1 ], {type: 'pie', height: '200px'});


        $('#bigstacked').sparkline([5,4,7,6,9,5,8,2,6,4,6,7,6,4,2,1,4,6,2,5,7,2,3,5,3,7,9], { type: 'bar', barColor: '#eceff1', height: '200px',width: '100%', barWidth: 10, barSpacing: 5, spotRadius: 4});
        $('#bigstacked').sparkline([4,1,5,7,9,9,8,7,6,6,4,7,8,4,3,2,2,5,6,7,8], { composite: true, fillColor: false, lineColor: '#03a9f4', lineWidth: 2, height: '200px', width: '100%', spotRadius: 4 });
    }


    var sparkResize;
 
    $(window).resize(function(e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparker, 500);
    });
    sparker();


});