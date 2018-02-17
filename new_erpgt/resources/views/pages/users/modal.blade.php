<div class="modal fade" id="UserModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="UserModalTitle">{{trans('auth.User_add?')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmUser', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="user_id" id="user_id" value="{{ isset($user->id)?$user->id:"" }}">

                <div class="field-wrapper UserForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <div class="col-md-6">
                            {{ Form::bsText('First_name','contact', null, []) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::bsText('Last_name','contact', null, []) }}
                            </div>
                            
                            <div class="col-md-6">
                                {{ Form::bsText('Email','contact', null, []) }}
                            </div>

                            <div class="col-md-6">
                                {{ Form::bsText('Phone','general', null, []) }}
                            </div>

                            <div class="col-md-6 col-md-offset-3">
                                    {{ Form::bsCheckboxChecked('Intern_contact', 'general', 'Intern_contact' , null, []) }}
                            </div>

                            <div class="col-md-6 col-md-offset-3">
                                    {{ Form::bsCheckbox('Map_creator', 'general', 'Map_creator' , null, []) }}
                            </div>

                            <div id="intern_contact_div">
                                <div class="col-md-12">
                                    {{ Form::bsSelect('Job','contact', $roles, []) }}
                                </div>
                            </div>
                            <div id="extern_contact_div">
                                <div class="col-md-12">
                                    {{ Form::bsText('CompanyName','general', null, []) }}
                                </div>
                                <div class="col-md-12">
                                    {{ Form::bsText('CompanyAddress','general', null, []) }}
                                </div>
                                <div class="col-md-12">
                                    {{ Form::bsText('CompanyPostalCode','general', null, []) }}
                                </div>
                                <div class="col-md-12">
                                    {{ Form::bsText('CompanyCity','general', null, []) }}
                                </div>
                                <div class="col-md-12">
                                    {{ Form::bsSelect('InterventionDomain','general', $intervention_domains, []) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveUser', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>