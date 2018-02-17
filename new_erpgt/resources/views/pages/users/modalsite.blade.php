<div class="modal fade" id="UserSiteModal" tabindex="-9" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="UserSiteModalTitle">{{trans('general.UserAdd')}}</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['id' => 'frmUserSite', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="user_id" id="user_id" value="{{ isset($user->id)?$user->id:"" }}">

                <div class="field-wrapper UserSiteForm">
                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ Form::bsSelect('site_id','general', $sites, []) }}
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                {!! link_to('#', $title=trans('general.Validate'), $attributes = ['id'=>'saveUserSite', 'class'=>'btn btn-lg btn-block btn-success btn-save']) !!}
            </div>

        </div>
    </div>
</div>