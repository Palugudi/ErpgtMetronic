<div class="table-responsive">
    <table class="table" id="DocumentTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('document.Document')}}</th>
                <th>{{trans('gtb.Document_type')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($documents as $document)
                @if(file_exists('documents/'.$document->site_id.'/documents/'.$document->filename))
                    <tr id="document{{ $document->id }}">
                        <td>
                            <a href="" OnClick='EditDocument({{ $document->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                            <a href="" OnClick="DeleteDocument({{ $document->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                        </td>
                        <td><a href="{{'../documents/'.$document->site_id.'/documents/'.$document->filename}}" target="_blank"> {{ $document->name}}</a></td>
                        <!--<td><a href="{{ url('site').'/'.$document->site_id.'/downloadFile/'.$document->filename }}"> {{ $document->name}}</a></td>-->
                        @if(isset($document_types[$document->document_type_id]['picture']))
                            <td><img src="{!! asset('images/documents/'.$document_types[$document->document_type_id]['picture']) !!}" alt="{{$document->picture}}" height="40" width="40"> {{ $document_types[$document->document_type_id]['name'] }}</td>
                        @else
                            <td><img src="{!! asset('images/documents/undefined.png') !!}" alt="{{$document->picture}}" height="40" width="40"> {{ $document_types[$document->document_type_id]['name'] }}</td>
                        @endif
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>