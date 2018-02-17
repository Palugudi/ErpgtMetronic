<div class="table-responsive">
    <table class="table" id="ElecHPTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('consumption.Consumption_date')}}</th>
                <th>{{trans('consumption.IndexHP')}}</th>
                <th>{{trans('consumption.Conso')}}</th>
                <th>{{trans('general.Comment')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($elecshp as $elec)
                <tr id="elec{{ $elec->id }}">
                    <td>
                        <a href="" OnClick='EditConsumption({{ $elec->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteConsumption({{ $elec->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
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