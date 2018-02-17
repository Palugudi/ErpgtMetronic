<div class="table-responsive">
    <table class="table" id="InterventionTypeTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('interventiontype.Interventiontype')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($interventiontypes as $interventiontype)
                <tr id="interventiontype{{ $interventiontype->id }}">
                    <td>
                        <a href="" OnClick='EditInterventiontype({{ $interventiontype->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteInterventiontype({{ $interventiontype->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td>
                    <td>{{ $interventiontype->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>