<div id="GraphGas"></div>

<script>
    var Gasseries = {!! isset($gazs)?$gazs : [] !!};
	Object.keys(Gasseries).forEach(function(key){
	    Gasseries[key][0] = parseToJsDate(Gasseries[key][0]);
	    Gasseries[key][1] = parseInt(Gasseries[key][1]);
	});

    Highcharts.chart('GraphGas', {
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
	        text: "{{ trans('consumption.Gaz') }}"
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
	            text: "{{ trans('consumption.Volume') }}"
	        },
	    },
	    tooltip: {
	        valueSuffix: ' m³'
	    },
	    plotOptions: {
	        spline: {
	            marker: {
	                enabled: true
	            }
	        }
	    },
	    series: [{
	        name: "{{ trans('consumption.GazTrace') }}",
	        data: Gasseries,
	        color : "#00bef2",
	    }]
	});
</script>
