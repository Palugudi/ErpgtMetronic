<div class="table-responsive">
	<table class="table" id="SitesTable">
		<thead>
			<tr>
				<th></th>
				<th>{{trans('gtb.Site')}}</th>
				<th>{{trans('general.Phone')}}</th>
				<th>{{trans('general.Email')}}</th>
				<th>{{trans('general.Address')}}</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($sites as $site)
				<tr id="site{{ $site->site_id }}">
					<td>
						<a href="" OnClick="DeleteUserSite({{ $site->site_id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
					</td>
					<th><a href="{{ Route('site.show', $site->site_id) }}">{{ $site->name}}</a></th>
					<td><a href="tel:{{ $site->phone }}">{{ $site->phone }}</a></td>
					<td><a href="mailto:{{ $site->email }}">{{ $site->email }}</a></td>
					<td>{{ $site->address }} {{ $site->postal_code }} {{ $site->city }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>