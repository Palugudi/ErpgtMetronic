@foreach ($pictures as $picture)
	@if(file_exists('documents/'.$site->id.'/pictures/'.$picture->picture))
	    <div class="col-sm-4 col-md-3" style="text-align: center;">
	        <div class="row">
	            <td><a href="{!! asset('documents/'.$site->id.'/pictures/'.$picture->picture) !!}" data-lightbox="{{$picture->picture}}"><img class="SmallPicture" src="{!! asset('documents/'.$site->id.'/pictures/'.$picture->picture) !!}" alt="{{$picture->picture}}"></a></td>
	        </div>
	        <div class="row">
	            <a href="" OnClick="DeletePicture({{ $picture->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
	        </div>
	    </div>
	@endif
@endforeach