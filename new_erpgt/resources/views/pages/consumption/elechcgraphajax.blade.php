<div id="GraphElecHC"></div>

<script>
    var Elecseries = {!! isset($elecshc)?$elecshc : [] !!};
	Object.keys(Elecseries).forEach(function(key){
	    Elecseries[key][0] = parseToJsDate(Elecseries[key][0]);
	    Elecseries[key][1] = parseInt(Elecseries[key][1]);
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
	
</script>
