<div class="table-responsive">
    <table class="table" id="WaterTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('consumption.Consumption_date')}}</th>
                <th>{{trans('consumption.Index')}}</th>
                <th>{{trans('consumption.Conso')}}</th>
                <th>{{trans('general.Comment')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($waters as $water)
                <tr id="water{{ $water->id }}">
                    <td>
                        <a class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details"
			                    href="" OnClick='EditConsumption({{ $water->id }});' data-toggle="modal">
				               <i class="la la-edit"></i>
			            </a>
			            
                         <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"
			                    OnClick="DeleteConsumption({{ $water->id }})" data-toggle="modal" >
				              <i class="la la-trash"></i>
			              </a>
                    </td>
                    <td>{{ format_date_simple($water->date) }}</td>
                    <td>{{ $water->statement}} m³</td>
                    <td>{{ $water->consumptions}} m³</td>
                    <td>{{ $water->comment}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>