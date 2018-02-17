<div class="table-responsive">
    <table class="table" id="ReportDocumentTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('report_document.Report_documents_list')}}</th>
                <th>{{trans('gtb.Document_type')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($report_documents as $report_document)
                @if(file_exists('documents/'.$site_id.'/reports/'.$report_document->report_id.'/documents/'.$report_document->filename))
                    <tr id="report_document{{ $report_document->id }}">
                        <td>
                            <a href="" OnClick="DeleteReport_document({{ $report_document->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                        </td>
                        <td><a href="{{'../documents/'.$site_id.'/reports/'.$report_document->report_id.'/documents/'.$report_document->filename}}" target="_blank"> {{ $report_document->name}}</a></td>
                        <!-- <td><a href="{{ url('site').'/'.$site_id.'/report/'.$report_document->report_id.'/downloadFile/'.$report_document->filename }}"> {{ $report_document->name}}</a></td> -->
                        <td>{{ $document_types[$report_document->document_type_id] }}</td>
                    </tr>

                @endif
            @endforeach
        </tbody>
    </table>
</div>