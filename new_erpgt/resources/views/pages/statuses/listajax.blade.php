<div class="table-responsive">
	<table class="table" id="StatusesTable">
		<thead>
			<tr>
				<th></th>
				<th>{{trans('gtb.Status')}}</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($statuses as $status)
				<tr id="status{{ $status->id }}">
					<td>
						<a href="" OnClick='EditStatus({{ $status->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
						<a href="" OnClick="DeleteStatus({{ $status->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
					</td>
					<td>{{ $status->name}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>