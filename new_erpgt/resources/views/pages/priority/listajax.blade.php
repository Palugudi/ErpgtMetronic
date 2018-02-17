<div class="table-responsive">
    <table class="table" id="PriorityTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('priority.Priority')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($prioritys as $priority)
                <tr id="priority{{ $priority->id }}">
                    <td>
                        <a href="" OnClick='EditPriority({{ $priority->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeletePriority({{ $priority->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td>
                    <td>{{ $priority->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>