<div id="GraphElecHP"></div>

<script>
    var Elecseries = {!! isset($elecshp)?$elecshp : [] !!};
	Object.keys(Elecseries).forEach(function(key){
	    Elecseries[key][0] = parseToJsDate(Elecseries[key][0]);
	    Elecseries[key][1] = parseInt(Elecseries[key][1]);
	});

    Highcharts.chart('GraphElecHP', {
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
	        text: "{{ trans('consumption.ElectricityHP') }}"
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
	Highcharts.setOptions({
		lang: {
			months: ["{{ trans('consumption.January') }}", "{{ trans('consumption.February') }}", "{{ trans('consumption.March') }}", "{{ trans('consumption.April') }}", "{{ trans('consumption.May') }}", "{{ trans('consumption.June') }}",  "{{ trans('consumption.July') }}", "{{ trans('consumption.August') }}", "{{ trans('consumption.September') }}", "{{ trans('consumption.October') }}", "{{ trans('consumption.November') }}", "{{ trans('consumption.December') }}"],
			weekdays: ["{{ trans('consumption.Sunday') }}", "{{ trans('consumption.Monday') }}", "{{ trans('consumption.Tuesday') }}", "{{ trans('consumption.Wednesday') }}", "{{ trans('consumption.Thursday') }}", "{{ trans('consumption.Friday') }}", "{{ trans('consumption.Saturday') }}"],
	        shortMonths: ["{{ trans('consumption.Jan') }}", "{{ trans('consumption.Feb') }}", "{{ trans('consumption.Mar') }}", "{{ trans('consumption.Apr') }}", "{{ trans('consumption.May') }}", "{{ trans('consumption.Jun') }}", "{{ trans('consumption.Jul') }}", "{{ trans('consumption.Aug') }}","{{ trans('consumption.Sep') }}", "{{ trans('consumption.Oct') }}", "{{ trans('consumption.Nov') }}","{{ trans('consumption.Dec') }}"]
		}
	});
</script>
