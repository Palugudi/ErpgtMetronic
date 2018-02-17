@foreach ($maps as $map)
	<div class="row">
		<br>
		<div class="row">
			<div class="col-md-9">
				{{$map->name}}
			</div>
			@if(Auth::user()->map_creator)
			<div class="col-md-3">
				<a href="" OnClick='EditMap({{ $map->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
				<a href="" OnClick="DeleteMap({{ $map->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
			</div>
			@endif
		</div>
		<div class="row">
			<td><a href="{{ Route('map.show', $map->id) }}" ><img class="SmallMap" src="{!! asset('documents/'.$map->site_id.'/maps/'.$map->picture) !!}" alt="{{$map->picture}}"></a></td>
		</div>
		<br>
	</div>
@endforeach