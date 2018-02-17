@foreach ($report_pictures as $report_picture)
	@if(file_exists('documents/'.$site_id.'/reports/'.$report_picture->report_id.'/pictures/'.$report_picture->picture))
	    <div class="col-sm-4 col-md-3" style="text-align: center;">
	        <div class="row">
	            <td><a href="{!! asset('documents/'.$site_id.'/reports/'.$report_picture->report_id.'/pictures/'.$report_picture->picture) !!}" data-lightbox="{{$report_picture->picture}}"><img class="SmallPicture" src="{!! asset('documents/'.$site_id.'/reports/'.$report_picture->report_id.'/pictures/'.$report_picture->picture) !!}" alt="{{$report_picture->picture}}"></a></td>
	        </div>
	        <div class="row">
	            <a href="" OnClick="DeletePicture({{ $report_picture->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
	        </div>
	    </div>
    @endif
@endforeach