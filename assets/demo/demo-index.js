jQuery(document).ready(function() {

    $(function() {

    //Switchery
        Switchery(document.querySelector('.js-switch-success'), {color: Utility.getBrandColor('success')});

    // EasyPieChart

        try {
            $('.easypiechart#progress').easyPieChart({
                barColor: "#cddc39",
                trackColor: 'rgba(255, 255, 255, 0.32)',
                scaleColor: false,
                scaleLength: 8,
                lineCap: 'square',
                lineWidth: 2,
                size: 96,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent-non').text(Math.round(percent));
                }
            });
        } catch(e) {}



    // Sparklines
     
        var sparker = function() {
            $('.spark-session').sparkline([15,14,17,11,8,12,15,24,17,16,17,14,10,8,11,17,15,13,17,18,16,10,9,1,4,9,13,11,12,15], { fillColor: '#f5f5f5', lineColor: '#e0e0e0', lineWidth: 2, height: '24px', width: '100%', spotRadius: 3, spotColor: 'transparent', highlightLineColor: 'rgba(0, 0, 0, 0.1)', maxSpotColor: 'transparent', minSpotColor: 'transparent', highlightSpotColor: '#e0e0e0'});
            $('.spark-users').sparkline([15,14,17,11,8,12,15,24,17,16,17,14,10,8,11,17,15,13,17,18,16,10,9,1,4,9,13,11,12,15], { fillColor: '#f5f5f5', lineColor: '#e0e0e0', lineWidth: 2, height: '24px', width: '100%', spotRadius: 3, spotColor: 'transparent', highlightLineColor: 'rgba(0, 0, 0, 0.1)', maxSpotColor: 'transparent', minSpotColor: 'transparent', highlightSpotColor: '#e0e0e0'});
            $('.spark-pagesession').sparkline([15,14,17,11,8,12,15,24,17,16,17,14,10,8,11,17,15,13,17,18,16,10,9,1,4,9,13,11,12,15], { fillColor: '#f5f5f5', lineColor: '#e0e0e0', lineWidth: 2, height: '24px', width: '100%', spotRadius: 3, spotColor: 'transparent', highlightLineColor: 'rgba(0, 0, 0, 0.1)', maxSpotColor: 'transparent', minSpotColor: 'transparent', highlightSpotColor: '#e0e0e0'});
            $('.spark-avgduration').sparkline([15,14,17,11,8,12,15,24,17,16,17,14,10,8,11,17,15,13,17,18,16,10,9,1,4,9,13,11,12,15], { fillColor: '#f5f5f5', lineColor: '#e0e0e0', lineWidth: 2, height: '24px', width: '100%', spotRadius: 3, spotColor: 'transparent', highlightLineColor: 'rgba(0, 0, 0, 0.1)', maxSpotColor: 'transparent', minSpotColor: 'transparent', highlightSpotColor: '#e0e0e0'});
            $('.spark-bouncerate').sparkline([15,14,17,11,8,12,15,24,17,16,17,14,10,8,11,17,15,13,17,18,16,10,9,1,4,9,13,11,12,15], { fillColor: '#f5f5f5', lineColor: '#e0e0e0', lineWidth: 2, height: '24px', width: '100%', spotRadius: 3, spotColor: 'transparent', highlightLineColor: 'rgba(0, 0, 0, 0.1)', maxSpotColor: 'transparent', minSpotColor: 'transparent', highlightSpotColor: '#e0e0e0'});

            $('.spark-pageviews').sparkline([300,280,340,220,160,240,300,480,340,320,340,280,200,160,220,340,300,260,340,360,320,200,180,20,80,180,260,220,240,300], { fillColor: '#fafbeb', lineColor: '#e6ee9c', lineWidth: 2, height: '120px', width: '100%', spotRadius: 3, spotColor: 'transparent', highlightLineColor: 'rgba(0, 0, 0, 0.1)', maxSpotColor: 'transparent', minSpotColor: 'transparent', highlightSpotColor: '#e6ee9c', chartRangeMax: 480, chartRangeMin: 0});
            $('.spark-pageviews').sparkline([150,140,170,110,80,120,150,240,170,160,170,140,100,80,110,170,150,130,170,180,160,100,90,10,40,90,130,110,120,150],     { fillColor: '#fbead7', lineColor: '#ffab91', lineWidth: 2, height: '120px', width: '100%', spotRadius: 3, spotColor: 'transparent', highlightLineColor: 'rgba(0, 0, 0, 0.1)', maxSpotColor: 'transparent', minSpotColor: 'transparent', highlightSpotColor: '#ffab91', composite: true, chartRangeMax: 480, chartRangeMin: 0});
            
        }
        var sparkResize;
     
        $(window).resize(function(e) {
            clearTimeout(sparkResize);
            sparkResize = setTimeout(sparker, 500);
        });
        sparker();
    });

    //World Map

    var randomNumbers = function (min, max, length) {
        var arr = [];
        var distance = max - min;
        for (var i = 0; i < length; i++) {
            arr.push(min+Math.round(Math.random() * distance))
        }

        return arr;
    }

    $('#worldmap').vectorMap({
        map: 'world_mill_en',
        backgroundColor: '#fff',
        zoomOnScroll: false,
        regionStyle: {
            initial: {
              fill: '#ddd',
              "fill-opacity": 1,
              stroke: 'none',
              "stroke-width": 0,
              "stroke-opacity": 1
            },
            hover: {
              "fill-opacity": 0.8,
              cursor: 'pointer'
            },
            selected: {
              fill: 'yellow'
            },
        },
        markerStyle: {
          initial: {
            fill: 'rgba(255, 61, 0, 0.7)',
            stroke: '#ff6e40',
            "fill-opacity": 1,
            "stroke-width": 0,
            "stroke-opacity": 0,
            r: 5
          },
          hover: {
            stroke: 'black',
            "stroke-width": 0,
            cursor: 'pointer'
          },
          selected: {
            fill: 'blue'
          },
          selectedHover: {
          }
        },

        markers: [
            {latLng: [40.7127, -74.0059], name: 'New York'},
            {latLng: [41.9033, 12.4533], name: 'Vatican City'},
            {latLng: [48.8567, 2.3508], name: 'Paris'},
            {latLng: [-31.9522, 115.8589], name: 'Perth'},
            {latLng: [-8.7619, -63.9039], name: 'Porto Velho'},
            {latLng: [39.9500, -75.1667], name: 'Philadelphia'},
            {latLng: [41.4822, -81.6697], name: 'Cleveland'},
            {latLng: [1.3, 103.8], name: 'Singapore'},
        ],
        series: {
            markers: [{
                attribute: 'r',
                scale: [3, 17],
                values: randomNumbers(200, 1500, 24)
            }]
        },
    });

    var wmap = $('#worldmap').children('.jvectormap-container').data('mapObject');    

    setInterval (function () {
        wmap.series.markers[0].setValues(randomNumbers(200, 1500, 24));
    }, 2000);


    //Loading Button in Timeline
    $('.loading-example-btn').click(function () {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function () {
          btn.button('reset')
        },3000 )
    });


    // Visitor Stats
        function randValue() {
            return (Math.floor(Math.random() * (2)));
        }

        var fans = [[1, 17], [2, 34], [3, 73], [4, 47], [5, 90], [6, 70], [7, 40]];
        var followers = [[1, 54], [2, 40], [3, 10], [4, 25], [5, 42], [6, 14], [7, 36]];

        var plot = $.plot($("#socialstats"),
            [{ data: fans, label: "Facebook" },
             { data: followers, label: "Twitter" }], {
                series: {

                    shadowSize: 0,
                    lines: { 
                        show: false,
                        lineWidth: 0
                    },
                    points: { show: true },
                    splines: {
                        show: true,
                        fill: 0.08,
                        tension: 0.3, // float between 0 and 1, defaults to 0.5
                        lineWidth: 2 // number, defaults to 2
                    },
                },
                grid: {
                    labelMargin: 8,
                    hoverable: true,
                    clickable: true,
                    borderWidth: 0,
                    borderColor: '#fafafa'
                },
                legend: {
                    backgroundColor: '#fff',
                    margin: 8
                },
                yaxis: { 
                    min: 0, 
                    max: 100, 
                    tickColor: '#fafafa', 
                    font: {color: '#bdbdbd', size: 12},
                    // tickFormatter: function (val, axis) {
                    //     if (val>999) {return (val/1000) + "K";} else {return val;}
                    // }
                },
                xaxis: { 
                    tickColor: 'transparent',
                    tickDecimals: 0, 
                    font: {color: '#bdbdbd', size: 12}
                },
                colors: ['#9fa8da', '#80deea'],
                tooltip: true,
                tooltipOpts: {
                    content: "x: %x, y: %y"
                }
            });

    // Earnings Stats


        var d1 = [
            [1, 2],
            [2, 4],
            [3, 1.25],
            [4, 3.5],
            [5, 4.5],
            [6, 2],
            [7, 2.75]
        ];
        var d2 = [
            [1, 1.5],
            [2, 3],
            [3, 0.75],
            [4, 2.75],
            [5, 3.25],
            [6, 1.5],
            [7, 2.15]
        ];
        var d3 = [
            [1, 0.35],
            [2, 1.75],
            [3, 0.15],
            [4, 0.75],
            [5, 0.15],
            [6, 0.7],
            [7, 1.5]
        ];

        var ds = new Array();

        ds.push({
        data:d1,
        label: "Revenues",
        bars: {
            show: true,
            barWidth: 0.12,
            order: 1
        }
        });
        ds.push({
            data:d2,
            label: "Earnings",
            bars: {
                show: true,
                barWidth: 0.12,
                order: 2
            }
        });
        ds.push({
            data:d3,
            label: "Referrals",
            bars: {
                show: true,
                barWidth: 0.12,
                order: 3
            }
        });

        var variance = $.plot($("#earnings"), ds, {
            series: {
                bars: {
                    show: true,
                    fill: 0.5,
                    lineWidth: 2
                }
            },
            grid: {
                labelMargin: 8,
                hoverable: true,
                clickable: true,
                tickColor: "#fafafa",
                borderWidth: 0
            },
            colors: ["#cfd8dc", "#78909c", "#ff5722"],
            xaxis: {
                autoscaleMargin: 0.08,
                tickColor: "transparent",
                ticks: [[1, "1"], [2, "2"], [3, "3"], [4, "4"],[5, "5"],[6, "6"],[7, "7"]],
                tickDecimals: 0,
                font: {
                    color: '#bdbdbd',
                    size: 12
                }
            },
            yaxis: {
                ticks: [0, 1, 2, 3, 4, 5],
                font: {
                    color: '#bdbdbd',
                    size: 12
                },
                tickFormatter: function (val, axis) {
                    return "$" + val + "K";
                }
            },
            legend : {
                backgroundColor: '#fff',
                margin: 8
            },
            tooltip: true,
            tooltipOpts: {
                content: "x: %x, y: %y"
            }
        });

    // Donut
        var datax = [
            { label: "Returning",  data: 68, color: '#7e57c2'},
            { label: "New",  data: 32, color: '#26c6da'}
        ];

        $.plot($("#newvsreturning"), datax,
            {
                series: {
                        pie: {
                            innerRadius: 0.55,
                            show: true,
                            // label: {
                            //     formatter: function (label, series) {
                            //         if (label=="New Visits")        { return '<div style="font-size:8pt;text-align:center; position:relative; left: 20px">' + label + '<br/>' + Math.round(series.percent) + '%</div>'; }
                            //         if (label=="Returning Visits")  { return '<div style="font-size:8pt;text-align:center; position:relative; right: 20px">' + label + '<br/>' + Math.round(series.percent) + '%</div>'; }
                            //     }
                            // }
                            offset : {
                                left: 0
                            }
                        }
                },
                legend: {
                    show: true,
                    margin: 8
                },
                grid: {
                    hoverable: true,
                    labelMargin: 8
                },
                tooltip: true,
                tooltipOpts: {
                    content: "%p.0%, %s"
                }

            });

    // Live Dynamic

        var dxta = [],
                totalPoints = 60;
            var updateInterval = 1000;

            function getRandomData() {

                if (dxta.length > 0)
                    dxta = dxta.slice(1);

                // Do a random walk

                while (dxta.length < totalPoints) {

                    var prev = dxta.length > 0 ? dxta[dxta.length - 1] : 25,
                        y = 10 + Math.random() * 37 - 13;

                    if (y < 0) {
                        y = 0;
                    } else if (y > 33) {
                        y = 50;
                    }

                    dxta.push(y);
                }

                // Zip the generated y values with the x values

                var res = [];
                for (var i = 0; i < dxta.length; ++i) {
                    res.push([i, dxta[i]])
                }

                return res;
            }

            var plot = $.plot("#realtime-updates", [ getRandomData() ], {
                series: {
                    bars: {
                        show: true,
                        lineWidth: 0,
                        barWidth: 0.75,
                        fill: 0.4
                    },
                    shadowSize: 0   // Drawing is faster without shadows
                },
                grid: {
                    labelMargin: 8,
                    hoverable: true,
                    clickable: true,
                    borderWidth: 0,
                    borderColor: '#f5f5f5'
                },
                yaxis: {
                    min: 0,
                    max: 50,
                    ticks: [0, 25, 50],
                    tickColor: '#f5f5f5', 
                    font: {color: '#bdbdbd', size: 12}
                },
                xaxis: {
                    show: false
                },
                colors: ['#00bcd4'],
                tooltip: true,
                tooltipOpts: {
                    content: "Active User: %y"
                }

            });

            function update() {

                plot.setData([getRandomData()]);

                // Since the axes don't change, we don't need to call plot.setupGrid()

                plot.draw();
                setTimeout(update, updateInterval);
            }

            update();
});