<div class="table-responsive">
	<table class="table" id="LocalisationTable">
		<thead>
			<tr>
				<th></th>
				<th>{{trans('gtb.Localisation')}}</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($localisations as $localisation)
				<tr id="localisation{{ $localisation->id }}">
					<td>
						<a href="" OnClick='EditLocalisation({{ $localisation->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
						<a href="" OnClick="DeleteLocalisation({{ $localisation->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
					</td>
					<td>{{ $localisation->name}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>