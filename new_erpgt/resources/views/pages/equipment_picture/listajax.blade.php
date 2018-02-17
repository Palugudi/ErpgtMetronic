@foreach ($equipment_pictures as $equipment_picture)
	@if(file_exists('documents/'.$site_id.'/equipments/'.$equipment_picture->equipment_id.'/pictures/'.$equipment_picture->picture))
	    <div class="col-sm-4 col-md-3" style="text-align: center;">
	        <div class="row">

	            <td><a href="{!! asset('documents/'.$site_id.'/equipments/'.$equipment_picture->equipment_id.'/pictures/'.$equipment_picture->picture) !!}" data-lightbox="{{$equipment_picture->picture}}"><img class="SmallPicture" src="{!! asset('documents/'.$site_id.'/equipments/'.$equipment_picture->equipment_id.'/pictures/'.$equipment_picture->picture) !!}" alt="{{$equipment_picture->picture}}"></a></td>
	        </div>
	        <div class="row">
	            <a href="" OnClick="DeletePicture({{ $equipment_picture->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
	        </div>
	    </div>
	@endif
@endforeach