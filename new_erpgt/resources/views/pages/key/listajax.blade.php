<div class="table-responsive">
    <table class="table" id="KeyTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('key.key_number')}}</th>
                <th>{{trans('key.building')}}</th>
                <th>{{trans('key.floor')}}</th>
                <th>{{trans('key.designation')}}</th>
                <th>{{trans('key.cylinder_number')}}</th>
                <th>{{trans('key.comments')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($keys as $key)
                <tr id="key{{ $key->id }}">
                    <td>
                        <a href="" OnClick='EditKey({{ $key->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteKey({{ $key->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td>
                    <td><a href="{{ Route('key.show', $key->id) }}">{{ $key->key_number}}</a></td>
                    <td>{{ $key->building}}</td>
                    <td>{{ $key->floor}}</td>
                    <td>{{ $key->designation}}</td>
                    <td>{{ $key->cylinder_number}}</td>
                    <td>{{ $key->comments}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>