<div id="GraphWater"></div>

<script>
    var Waterseries = {!! isset($waters)?$waters : [] !!};
	Object.keys(Waterseries).forEach(function(key){
	    Waterseries[key][0] = parseToJsDate(Waterseries[key][0]);
	    Waterseries[key][1] = parseInt(Waterseries[key][1]);
	});

    Highcharts.chart('GraphWater', {
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
	        text: "{{ trans('consumption.Water') }}"
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
	        name: "{{ trans('consumption.WaterTrace') }}",
	        data: Waterseries,
	        color : "#00bef2",
	    }]
	});
</script>
