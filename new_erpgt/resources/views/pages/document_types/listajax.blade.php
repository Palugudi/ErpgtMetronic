<div class="table-responsive">
	<table class="table" id="DocumentTypeTable">
		<thead>
			<tr>
				<th></th>
				<th>{{trans('gtb.Document_type')}}</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($document_types as $document_type)
				<tr id="document_type{{ $document_type->id }}">
					<td>
						<a href="" OnClick='EditDocumentType({{ $document_type->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
						<a href="" OnClick="DeleteDocumentType({{ $document_type->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
					</td>
					<td>
					@if(isset($document_type->picture))
						<img src="{!! asset('images/documents/'.$document_type->picture) !!}" alt="{{$document_type->picture}}" height="40" width="40">
					@else
						<img src="{!! asset('images/documents/undefined.png') !!}" alt="document" height="40" width="40">
					@endif
					 {{ $document_type->name}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>