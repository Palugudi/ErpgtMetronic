<div class="table-responsive">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('consumption.Consumption')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($gazs as $gas)
                <tr id="gas{{ $gas->id }}">
                    <td>
                        <a href="" OnClick='EditConsumption({{ $gas->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteConsumption({{ $gas->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td>
                    <td>{{ $gas->sate}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>