<div class="table-responsive">
    <table class="table" id="EntrepriseTable">
        <thead>
            <tr>
                {{-- <th></th> --}}
                <th>{{trans('enterprise.Activity_domain')}}</th>
                <th>{{trans('enterprise.Enterprise')}}</th>
                <th>{{trans('enterprise.Contact')}}</th>
                <th>{{trans('general.Email')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($enterprises as $enterprise)
                <tr id="enterprise{{ $enterprise->id }}">
                    {{-- <td>
                        <a href="" OnClick='EditEnterprise({{ $enterprise->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteEnterprise({{ $enterprise->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td> --}}
                    <td>{{ $domains[$enterprise->intervention_domain]->name }}</td>
                    <td>{{ $enterprise->company_name}}</td>
                    <td>{{ $enterprise->first_name.' '.$enterprise->last_name }}</td>
                    <td><a href="mailto:{{ $enterprise->email }}">{{ $enterprise->email }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>