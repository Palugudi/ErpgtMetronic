<div class="modal fade" id="InternalcommentModal" tabindex="-9" role="dialog" aria-labelledby="internalCommentModalTitle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="internalCommentModalTitle">{{trans('internalcomment.Internalcomment_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmInternalcomment', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="internalcomment_id" id="internalcomment_id" value="">
                <input type="hidden" name="internalcomment_intervention" id="internalcomment_intervention" value="">

                <div class="field-wrapper InternalcommentForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsTextarea('i_comment','internalcomment', null, []) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveInternalcomment', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>