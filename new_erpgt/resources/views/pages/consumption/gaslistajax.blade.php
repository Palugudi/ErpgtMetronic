<div class="table-responsive">
    <table class="table" id="GasTable">
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
            @foreach ($gazs as $gas)
                <tr id="gas{{ $gas->id }}">
                    <td>
                        <a href="" OnClick='EditConsumption({{ $gas->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteConsumption({{ $gas->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
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