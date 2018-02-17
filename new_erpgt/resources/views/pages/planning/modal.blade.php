<div class="modal fade" id="PlanningModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="planningModalTitle">{{trans('planning.Planning_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmPlanning', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="planning_id" id="planning_id" value="">
                <input type="hidden" name="site_id" id="site_id" value="{{ isset($equipment->site_id)?$equipment->site_id:"" }}">
                <input type="hidden" name="equipment_id" id="equipment_id" value="{{ isset($equipment->id)?$equipment->id:"" }}">

                <div class="field-wrapper PlanningForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsText('Name','planning', null, ['required' => '', 'autofocus' => '']) }}
                            {{ Form::bsDatetimepicker('Date','planning', null, ['required' => '']) }}
                            {{ Form::bsText('Description','planning', null, []) }}
                            {{ Form::bsDatetimepicker('Reminder','planning', null, []) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'savePlanning', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>