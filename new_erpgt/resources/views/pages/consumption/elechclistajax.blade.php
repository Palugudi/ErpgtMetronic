<div class="table-responsive">
    <table class="table" id="ElecHCTable" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>{{trans('consumption.Consumption_date')}}</th>
                <th>{{trans('consumption.IndexHC')}}</th>
                <th>{{trans('consumption.Conso')}}</th>
                <th>{{trans('general.Comment')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($elecshc as $elec)
                <tr id="elec{{ $elec->id }}">
                    <td>
                         <a class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details"
			                    href="" OnClick='EditConsumption({{ $elec->id }});' data-toggle="modal">
				               <i class="la la-edit"></i>
			            </a>
			            
                         <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"
			                    OnClick="DeleteConsumption({{ $elec->id }})" data-toggle="modal" >
				              <i class="la la-trash"></i>
			              </a>
                    </td>
                    <td>{{ format_date_simple($elec->date) }}</td>
                    <td>{{ $elec->statement}} kWh</td>
                    <td>{{ $elec->consumptions}} kWh</td>
                    <td>{{ $elec->comment}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>