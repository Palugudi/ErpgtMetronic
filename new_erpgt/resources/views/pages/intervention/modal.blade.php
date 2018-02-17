<div class="modal fade" id="InterventionModal" tabindex="-9" role="dialog" aria-labelledby="interventionModalTitle">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: -195px;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="interventionModalTitle">{{trans('intervention.Intervention_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmIntervention', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="intervention_id" id="intervention_id" value="">

                <div class="field-wrapper InterventionForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsSelect('Site','gtb', $sites) }}
                            {{ Form::bsSelect('Assigned','gtb', $assigned) }}
                            {{ Form::bsSelect('Domain','gtb', $domains) }}
                            {{ Form::bsText('ReferenceWO','intervention', null, ['required' => '']) }}
                            {{ Form::bsSelect('Interventionstatus','intervention', $interventionstatuses) }}
                            {{ Form::bsSelect('Interventiontype','intervention', $interventiontypes) }}
                            {{ Form::bsTextarea('Request','intervention', null, []) }}
                            {{ Form::bsSelect('Priority','intervention', $priorities) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveIntervention', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>