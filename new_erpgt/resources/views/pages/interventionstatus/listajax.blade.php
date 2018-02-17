<div class="table-responsive">
    <table class="table" id="InterventionStatusTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('interventionstatus.Interventionstatus')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($interventionstatuss as $interventionstatus)
                <tr id="interventionstatus{{ $interventionstatus->id }}">
                    <td>
                        <a href="" OnClick='EditInterventionstatus({{ $interventionstatus->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteInterventionstatus({{ $interventionstatus->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td>
                    <td>{{ $interventionstatus->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>