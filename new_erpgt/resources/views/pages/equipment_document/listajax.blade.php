<div class="table-responsive">
    <table class="table" id="EquipmentDocumentTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('equipment_document.Equipment_documents_list')}}</th>
                <th>{{trans('gtb.Document_type')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($equipment_documents as $equipment_document)
                @if(file_exists('documents/'.$site_id.'/equipments/'.$equipment_document->equipment_id.'/documents/'.$equipment_document->filename))
                    <tr id="equipment_document{{ $equipment_document->id }}">
                        <td>
                            <a href="" OnClick="DeleteEquipment_document({{ $equipment_document->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                        </td>
                        <td><a href="{{'../documents/'.$site_id.'/equipments/'.$equipment_document->equipment_id.'/documents/'.$equipment_document->filename}}" target="_blank"> {{ $equipment_document->name}}</a></td>
                        <!-- <td><a href="{{ url('site').'/'.$site_id.'/equipment/'.$equipment_document->equipment_id.'/downloadFile/'.$equipment_document->filename }}"> {{ $equipment_document->name}}</a></td> -->
                        <td>{{ $document_types[$equipment_document->document_type_id] }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>