<div class="table-responsive">
    <table class="table" id="TimeTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('time.user')}}</th>
                <th>{{trans('time.date')}}</th>
                <th>{{trans('time.timeused')}}</th>
                <th>{{trans('time.type')}}</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($times as $time)
                <tr id="time{{ $time->id }}">
                    @if ($time->user_id == Auth::user()->id)
                        <td>
                            <a href="" OnClick='EditTime({{ $time->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                            <a href="" OnClick="DeleteTime({{ $time->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                        </td>
                    @else
                        <td></td>
                    @endif
                    <td>{{ $user_names[$time->user_id]}}</td>
                    <td>{{ format_date_simple($time->date)}}</td>
                    @if($time->time_used > 1)
                        <td>{{ $time->time_used}} {{ trans('time.hours') }}</td>
                    @else
                        <td>{{ $time->time_used}} {{ trans('time.hour') }}</td>
                    @endif
                    <td>{{ $types[$time->time_type_id]}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>