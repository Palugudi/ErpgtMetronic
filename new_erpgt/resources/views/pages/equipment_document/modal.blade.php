<div class="modal fade" id="Equipment_documentModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('equipment_document.Equipment_document_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmEquipment_document', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="equipment_document_id" id="equipment_document_id" value="">
                <input type="hidden" name="equipment_id" id="equipment_id" value="{{ $equipment->id }}">

                <div class="field-wrapper Equipment_documentForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsText('Equipment_document','equipment_document', null, ['required' => '', 'autofocus' => '']) }}
                            {{ Form::bsFile('Doc','general', ['required' => '']) }}
                            {{ Form::bsSelect('Document_type', 'gtb', $document_types, []) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveEquipment_document', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>