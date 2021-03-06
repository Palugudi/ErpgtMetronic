<div id="GraphElecHC"></div>

<script>

	var Elecseries = {!! isset($elecshc)?$elecshc : [] !!};
	let data = []
	let date = [];
	// console.log(Object.keys(Elecseries));
	Object.keys(Elecseries).forEach(function(key){
	    Elecseries[key][0] = parseToJsDate(Elecseries[key][0]);
		Elecseries[key][1] = parseInt(Elecseries[key][1]);
		data.push(Elecseries[key][1]);
		date.push( new Date(Elecseries[key][0]));
	});


    Highcharts.chart('GraphElecHC', {
	    lang: {
	        decimalPoint: "{{ trans('consumption.DecimalPoint') }}",
	        downloadPNG: "{{ trans('consumption.DownloadPNG') }}",
	        downloadJPEG: "{{ trans('consumption.DownloadJPEG') }}",
	        downloadPDF: "{{ trans('consumption.DownloadPDF') }}",
	        downloadSVG: "{{ trans('consumption.DownloadSVG') }}",
	        exportButtonTitle: "{{ trans('consumption.ExportButtonTitle') }}",
	        loading: "{{ trans('consumption.Loading') }}",
	        printChart: "{{ trans('consumption.PrintChart') }}",
	        resetZoom: "{{ trans('consumption.ResetZoom') }}",
	        resetZoomTitle: "{{ trans('consumption.ResetZoomTitle') }}",
	        thousandsSep: "{{ trans('consumption.ThousandSep') }}",
	    },
	    credits: {
	        enabled: false
	    },
	    chart: {
	        type: 'spline'
	    },
	    title: {
	        text: "{{ trans('consumption.Trace') }}"
	    },
	    legend: {
	        enabled: false
	    },
	    subtitle: {
	        text: "{{ trans('consumption.ElectricityHC') }}"
	    },
	    xAxis: {
	        type: 'datetime',
	        labels: {
	            overflow: 'justify'
	        },
	        dateTimeLabelFormats: {
	            month: '%b %Y',
	            year: '%Y'
	        },
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: "{{ trans('consumption.Power') }}"
	        },
	    },
	    tooltip: {
	        valueSuffix: ' kWh'
	    },
	    plotOptions: {
	        spline: {
	            marker: {
	                enabled: true
	            }
	        }
	    },
	    series: [{
	        name: "{{ trans('consumption.ElectricalTrace') }}",
	        data: Elecseries,
	        color : "#00bef2",
	    }]
	});

    var trendsStats = function() {
        if ($('#m_elechcgraph').length == 0) {
            return;
        }

        var ctx = document.getElementById("m_elechcgraph").getContext("2d");

        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, Chart.helpers.color('#00c5dc').alpha(0.7).rgbString());
        gradient.addColorStop(1, Chart.helpers.color('#f2feff').alpha(0).rgbString());

        var config = {
            type: 'line',
            data: {
                labels: date,
                datasets: [{
                    label: "{{ trans('consumption.ElectricalTrace') }}",
                    backgroundColor: gradient, // Put the gradient here as a fill color
                    borderColor: '#0dc8de',

                    pointBackgroundColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointHoverBackgroundColor: mUtil.getColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.2).rgbString(),

                    //fill: 'start',
                    data: data
                }]
            },
            options: {
                title: {
                    display: true,
                },
                tooltips: {
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        gridLines: true,
                        scaleLabel: {
                            display: true,
                            labelString: "{{ trans('consumption.Power') }}"
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.19
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 5,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
	}
	
	trendsStats();
</script>
