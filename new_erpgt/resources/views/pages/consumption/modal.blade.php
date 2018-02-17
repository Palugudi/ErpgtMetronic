<div class="modal fade" id="ConsumptionModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('consumption.Consumption_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmConsumption', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="consumption_id" id="consumption_id" value="">
                <input type="hidden" name="site_id" id="site_id" value="{{ $site->id }}">

                <div class="field-wrapper ConsumptionForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsDatetimepicker('Consumption_date','consumption', null, ['required' => '', 'autofocus' => '']) }}
                            {{ Form::bsSelect('Energy','energy', $energies) }}
                            {{ Form::bsText('Consumption','consumption', null, ['required' => '']) }}
                            {{ Form::bsTextarea('Comment','general', null, ['rows' => '3']) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveConsumption', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>