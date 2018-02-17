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
                       <a href="" OnClick='EditConsumption({{ $water->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                       <a href="" OnClick="DeleteConsumption({{ $water->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
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