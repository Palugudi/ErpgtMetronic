<div class="table-responsive">
    <table class="table" id="TimeTypeTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('time_type.Time_type')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($time_types as $time_type)
                <tr id="time_type{{ $time_type->id }}">
                    <td>
                        <a href="" OnClick='EditTime_type({{ $time_type->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteTime_type({{ $time_type->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td>
                    <td>{{ $time_type->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 