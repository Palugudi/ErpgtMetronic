<div class="table-responsive">
	<table class="table" id="DomainTable">
		<thead>
			<tr>
				<th> Actions</th>
				<th>{{trans('gtb.Domain')}}</th>
				<th>{{trans('gtb.Color')}}</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($domains as $domain)
				<tr id="domain{{ $domain->id }}">
					<td>

						<a class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details"
			                    href="" OnClick='EditDomain({{ $domain->id }});' data-toggle="modal">
				               <i class="la la-edit"></i>
			            </a>
			            
                         <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"
						      OnClick="DeleteDomain({{ $domain->id }})" data-toggle="modal" >
				              <i class="la la-trash"></i>
			              </a>
					</td>
					<td><img src="{!! asset('images/domains/'.$domain->picture) !!}" alt="{{$domain->picture}}" height="40" width="40"> {{ $domain->name}}</td>
					<td bgcolor="#{{$domain->color}}"></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>