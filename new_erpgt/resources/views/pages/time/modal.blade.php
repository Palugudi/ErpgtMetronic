<div class="modal fade" id="TimeModal" tabindex="-9" role="dialog" aria-labelledby="timeUsedModalTitle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="timeUsedModalTitle">{{trans('time.Time_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmTime']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="time_id" id="time_id" value="">
                <input type="hidden" name="time_intervention" id="time_intervention" value="">

                <div class="field-wrapper TimeForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsDatetimepicker('date','time', null, ['required' => '', 'autofocus' => '']) }}
                            {{ Form::bsNumber('time_used','time', null, ['required' => '']) }}
                            {{ Form::bsSelect('type','time', $types, ['required' => '']) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveTime', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>