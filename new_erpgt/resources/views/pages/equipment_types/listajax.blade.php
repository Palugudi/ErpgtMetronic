<div class="table-responsive">
	<table class="table" id="EquipmentTypeTable">
		<thead>
			<tr>
				<th></th>
				<th>{{trans('gtb.Equipment_type')}}</th>
				<th>{{trans('gtb.Domain')}}</th>
				<th>{{trans('gtb.Maintenance')}}</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($equipment_types as $equipment_type)
				<tr id="equipment_type{{ $equipment_type->id }}">
					<td>
						<a href="" OnClick='EditEquipment_type({{ $equipment_type->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
						<a href="" OnClick="DeleteEquipment_type({{ $equipment_type->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
					</td>
					<td>
					@if(isset($equipment_type->picture))
						<img src="{!! asset('images/equipments/'.$equipment_type->picture) !!}" alt="{{$equipment_type->picture}}" height="40" width="40">
					@else
						<img src="{!! asset('images/equipments/undefined.png') !!}" alt="equipment" height="40" width="40">
					@endif
					 {{ $equipment_type->name}}</td>
					<td>{{ $domains[$equipment_type->domain_id]}}</td>
					@if(file_exists('documents/gammes_maintenance/'.$equipment_type->maintenance))
						<td><a href="{{'documents/gammes_maintenance/'.$equipment_type->maintenance}}" target="_blank"> {{ $equipment_type->maintenance}}</a></td>
					@else
						<td></td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
</div>