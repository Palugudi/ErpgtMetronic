<div class="modal fade" id="EnterpriseModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('enterprise.Enterprise_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmEnterprise', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="enterprise_id" id="enterprise_id" value="">
                <input type="hidden" name="site_id" id="site_id" value="{{ $site->id }}">

                <div class="field-wrapper EnterpriseForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsText('Company','enterprise', null, ['required' => '', 'autofocus' => '']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::bsText('Contact_first_name','enterprise', null, []) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::bsText('Contact_last_name','enterprise', null, []) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::bsText('Contact_email','enterprise', null, []) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::bsText('Contact_number','enterprise', null, []) }}
                        </div>
                        <div class="col-md-12">
                            {{ Form::bsText('Address','enterprise', null, []) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::bsText('Postal_code','enterprise', null, []) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::bsText('City','enterprise', null, []) }}
                        </div>
                        <div class="col-md-12">
                            {{ Form::bsText('Activity_domain','enterprise', null, []) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveEnterprise', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>