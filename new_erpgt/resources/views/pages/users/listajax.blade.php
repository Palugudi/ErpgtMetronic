<div class="table-responsive">
    <table class="table" id="UserTable">
        <thead>
            <tr>
                {{--  <th></th> --}}
                <th>{{trans('general.User')}}</th>
                <th>{{trans('contact.Job')}}</th>
                <th>{{trans('general.Email')}}</th>
                <th>{{trans('general.Map_creator')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr id="user{{ $user->user_id }}">
                    {{-- <td>
                        <a href="" OnClick='EditUser({{ $user->user_id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteUser({{ $user->user_id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td>  --}}
                    <td><a href="{{ route('users.show', $user->user_id) }}">{{ $user->first_name.' '.$user->last_name }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</a></td>
                    <td>{{ ($user->map_creator ? trans('general.Map_creator_true') : trans('general.Map_creator_false')) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>