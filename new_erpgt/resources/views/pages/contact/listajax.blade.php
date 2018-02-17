<div class="portlet-body flip-scroll">
    <table class="table table-bordered table-striped table-condensed flip-content table-advance table-hover">
        <thead class="flip-content" style="background-color: #3598BC;">
            <tr style="color:#fff;">
                {{--  <th></th> --}}
                <th>{{trans('contact.Contact')}}</th>
                <th>{{trans('contact.Job')}}</th>
                <th>{{trans('general.Email')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($contacts as $contact)
                <tr id="contact{{ $contact->user_id }}">
                   {{--  <td>
                        <a href="" OnClick='EditContact({{ $contact->user_id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteContact({{ $contact->user_id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td> --}}
                    <td>{{ $contact->first_name.' '.$contact->last_name }}</td>
                    <td>{{ $contact->name}}</td>
                    <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>