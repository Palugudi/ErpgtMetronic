<div class="table-responsive">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('consumption.Consumption')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($elecs as $elec)
                <tr id="elec{{ $elec->id }}">
                    <td>
                        <a href="" OnClick='EditConsumption({{ $elec->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteConsumption({{ $elec->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td>
                    <td>{{ $elec->date}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>