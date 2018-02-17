<div class="modal fade" id="OrderModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="OrderModalTitle">{{trans('order.Order_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmOrder', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="order_id" id="order_id" value="">
                <input type="hidden" name="site_id" id="site_id" value="">
                <input type="hidden" name="user_id" id="user_id" value="">

                <div class="field-wrapper OrderForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            @if(!$in_equipment_show)
                                {{ Form::bsSelect('equipment','order', $equipments_list, []) }}
                                <div id="localisation_div" hidden="true">
                                    {{ Form::bsSelect('localisation','order', $localisations, []) }}
                                    {{ Form::bsSelect('equipment_type','order', $equipment_types, []) }}
                                </div>
                            @endif
                            {{ Form::bsText('material', 'order', null, []) }}
                            {{ Form::bsNumber('quantity','order', null, []) }}
                            {{ Form::bsText('reference','order', null, []) }}
                            {{ Form::bsSelect('brand','order', $brands, []) }}
                            {{ Form::bsText('model','order', null, []) }}
                            {{ Form::bsText('comment','order', null, []) }}
                            @if(!$in_intervention_show)
                                {{ Form::bsSelect('intervention', 'order', $interventions, []) }}
                            @endif
                            {{ Form::bsSelect('Order_status', 'order', $o_statuses, ['autofocus' => '']) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveOrder', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>