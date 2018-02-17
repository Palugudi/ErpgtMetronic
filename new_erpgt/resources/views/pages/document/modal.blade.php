<div class="modal fade" id="DocumentModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('document.Document_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmDocument', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="document_id" id="document_id" value="">
                <input type="hidden" name="site_id" id="site_id" value=""> //$site->id

                <div class="field-wrapper DocumentForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsText('Document','document', null, ['required' => '', 'autofocus' => '']) }}
                            {{ Form::bsSelect('Document_type','gtb', $document_types) }}
                            {{ Form::bsFile('Doc','general', ['required' => '']) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveDocument', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>