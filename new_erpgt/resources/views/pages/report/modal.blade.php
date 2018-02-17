<div class="modal fade" id="ReportModal" tabindex="-9" role="dialog" aria-labelledby="myReportModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myReportModalLabel">{{trans('report.Report_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmReport', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="report_id" id="report_id" value="">
                <input type="hidden" name="user_id" id="user_id" value="">

                <div class="field-wrapper ReportForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsDatetimepicker('ReportDate','report', null, ['required' => '', 'autofocus' => '']) }}
                            @if(!$in_equipment_show)
                                {{ Form::bsSelect('Equipment', 'report', $equipments, []) }}
                            @endif
                            @if(!$in_intervention_show)
                                {{ Form::bsSelect('Intervention', 'report', $interventions, []) }}
                            @endif
                            {{ Form::bsTextarea('Flaw', 'report', null, []) }}
                            {{ Form::bsTextarea('Cause', 'report', null, []) }}
                            {{ Form::bsTextarea('Solution', 'report', null, []) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveReport', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>