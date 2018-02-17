<div class="table-responsive">
	<table class="table" id="BrandTable">
		<thead>
			<tr>
				<th> Actions </th>
				<th>{{trans('gtb.Brand')}}</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($brands as $brand)
				<tr id="brand{{ $brand->id }}">
					<td>
						<a class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details"
			                    href="" OnClick='EditBrand({{ $brand->id }});' data-toggle="modal">
				               <i class="la la-edit"></i>
			            </a>
			            
                         <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"
						        OnClick="DeleteBrand({{ $brand->id }})" data-toggle="modal" >
				              <i class="la la-trash"></i>
			              </a>

					</td>
					<td>{{ $brand->name }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>