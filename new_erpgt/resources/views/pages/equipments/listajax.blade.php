<div class="table-responsive">
	<table class="table" id="EquipmentTable">
		<thead>
			<tr>
				<th></th>
				<th>{{trans('gtb.Equipment')}}</th>
				<th>{{trans('gtb.Domain')}}</th>
				<th>{{trans('gtb.map')}}</th>
				<th>{{trans('gtb.Localisation')}}</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($equipments as $equipment)
				<tr id="equipment{{ $equipment->id }}">
					<!-- <td>
						<a href="" OnClick='EditEquipment({{ $equipment->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
						<a href="" OnClick="DeleteEquipment({{ $equipment->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
					</td> -->
					<td><a href="" OnClick='EditEquipment({{ $equipment->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a></td>
					@if(isset($equipment->picture))
						<td><img src="{!! asset('images/equipments/'.$equipment->picture) !!}" alt="{{$equipment->picture}}" height="40" width="40"> <a href="{{ Route('equipment.show', $equipment->id) }}">{{ $equipment->equipment_name}}</a></td>
					@else
						<td><img src="{!! asset('images/equipments/undefined.png') !!}" alt="{{$equipment->picture}}" height="40" width="40"> <a href="{{ Route('equipment.show', $equipment->id) }}">{{ $equipment->equipment_name}}</a></td>
					@endif
					<td>{{ $domains[$equipment->domain_id] }}</a></td>
					<td><a href="{{ Route('map.show', $equipment->map_id) }}">{{ $maps[$equipment->map_id] }}</a></td>
					<td>{{ $localisations[$equipment->localisation_id]}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>