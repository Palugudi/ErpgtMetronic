<div class="modal fade" id="Report_documentModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('report_document.Report_document_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmReport_document', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="report_document_id" id="report_document_id" value="">
                <input type="hidden" name="report_id" id="report_id" value="{{ $report->id }}">

                <div class="field-wrapper Report_documentForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsText('Report_document','report_document', null, ['required' => '', 'autofocus' => '']) }}
                            {{ Form::bsFile('Doc','general', ['required' => '']) }}
                            {{ Form::bsSelect('Document_type', 'gtb', $document_types, []) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveReport_document', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>