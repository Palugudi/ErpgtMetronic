<div class="modal fade" id="KeyModal" tabindex="-9" role="dialog" aria-labelledby="myKeyModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myKeyModalLabel">{{trans('key.Key_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmKey', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="key_id" id="key_id" value="">
                <input type="hidden" name="site_id" id="site_id" value="">

                <div class="field-wrapper KeyForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsText('key_number','key', null, ['required' => '', 'autofocus' => '']) }}
                            {{ Form::bsText('building','key', null, ['required' => '', 'autofocus' => '']) }}
                            {{ Form::bsText('floor','key', null, ['required' => '', 'autofocus' => '']) }}
                            {{ Form::bsText('designation','key', null, ['required' => '', 'autofocus' => '']) }}
                            {{ Form::bsText('cylinder_number','key', null, ['required' => '', 'autofocus' => '']) }}
                            {{ Form::bsText('comments','key', null, ['required' => '', 'autofocus' => '']) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveKey', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>