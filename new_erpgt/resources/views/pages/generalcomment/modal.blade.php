<div class="modal fade" id="GeneralcommentModal" tabindex="-9" role="dialog" aria-labelledby="generalCommentModalTitle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="generalCommentModalTitle">{{trans('generalcomment.Generalcomment_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmGeneralcomment', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="generalcomment_id" id="generalcomment_id" value="">
                <input type="hidden" name="generalcomment_intervention" id="generalcomment_intervention" value="">

                <div class="field-wrapper GeneralcommentForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsTextarea('g_comment','generalcomment', null, []) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveGeneralcomment', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>