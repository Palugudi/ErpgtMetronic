<div class="table-responsive">
    <table class="table" id="GasTable" width="100%">
        <thead>
            <tr>
                <th>Actions</th>
                <th>{{trans('consumption.Consumption_date')}}</th>
                <th>{{trans('consumption.Index')}}</th>
                <th>{{trans('consumption.Conso')}}</th>
                <th>{{trans('general.Comment')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($gazs as $gas)
                <tr id="gas{{ $gas->id }}">
                    <td>
                         <a class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details"
			                    href="" OnClick='EditConsumption({{ $gas->id }});' data-toggle="modal">
				               <i class="la la-edit"></i>
			            </a>
			            
                         <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"
			                    OnClick="DeleteConsumption({{ $gas->id }})" data-toggle="modal" >
				              <i class="la la-trash"></i>
			              </a>
                    </td>
                    <td>{{ format_date_simple($gas->date) }}</td>
                    <td>{{ $gas->statement}} m³</td>
                    <td>{{ $gas->consumptions}} m³</td>
                    <td>{{ $gas->comment}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>